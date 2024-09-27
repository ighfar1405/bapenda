<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Nomor</label>
            <input type="text" class="form-control" name="nomor" :readonly="isReadOnly">
            <input type="checkbox" name="nomor_auto" @click="changeReadonly" checked/> Penomoran otomatis
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div>
          <div class="form-group">
            <label class="form-control-label">Tanggal Pembayaran</label>
            <input
              v-model="tanggalTbp"
              type="date"
              data-date=""
              @change="getPemakaiData()"
              data-date-format="DD MMMM YYYY"
              name="tanggal"
              class="form-control datePicker">
          </div>
        </div>
      </div>
      <div class="col-md-3 d-none">
        <div class="pr-lg-4">
          <div class="form-group">
            <label class="form-control-label">SKRD</label>
            <div class="custom-control custom-radio mb-3">
              <input v-model="skrd_radio"
                type="radio" id="radioSkrd" name="skrd_radio" class="custom-control-input" value="with_skrd" checked>
              <label class="custom-control-label" for="radioSkrd">Berdasarkan SKRD</label>
            </div>
            <!-- <div class="custom-control custom-radio">
              <input v-model="skrd_radio"
                type="radio" id="radioNoSkrd" name="skrd_radio" class="custom-control-input" value="no_skrd">
              <label class="custom-control-label" for="radioNoSkrd">Tidak Berdasarkan SKRD</label>
            </div> -->
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <div class="pl-lg-4">
          <div class="form-group">
          <label class="form-control-label">Pemakai</label>
          <input
            type="text"
            placeholder="Masukkan nama pemakai"
            v-model="query"
            @keyup="getPemakaiData()"
            autocomplete="off"
            :disabled="tanggalTbp === null"
            class="form-control input-lg"
          />
          <input type="hidden" name="pemakai" v-model="selectedPemakai">
          <div class="panel-footer" v-if="search_data.length">
            <ul class="list-group">
              <a
                href="#"
                class="list-group-item"
                v-for="item in search_data"
                :key="item.id"
                @click="getSelectedPemakai(item, $event)"
              >{{ item.nama }}<br/><small>{{ item.alamat }}, {{ item.kelurahan.nama }}</small></a>
            </ul>
        </div>
        </div>
        </div>
      </div>

      <div v-if="skrd_radio === 'with_skrd'"
        class="col-md-6">
        <div class="pr-lg-4">
          <div class="form-group">
            <label class="form-control-label">Total Piutang</label>
            <money class="form-control"
              :value="totalPiutang"
              :readonly="true"
              v-bind="money"></money>
          </div>
        </div>
      </div>

      <div v-else
        class="col-md-4">
        <div class="pr-lg-4">
          <div class="form-group">
            <label class="form-control-label">Objek Retribusi</label>
            <select name="objek"
              class="form-control"
              @change="setObjectRetribusi()"
              v-model="selectedObjectRetribusi">
              <option value="">-- Pilih Objek Retribusi --</option>
              <option v-for="item in objectRetribusiOptions" :key="item.id"
                :value="item.id">{{ item.kode }} - {{ item.lokasi }}</option>
            </select>
          </div>
        </div>
      </div>


    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Nama Kas Bank</label>
            <select v-model="selectedRekening" name="kas_bank" class="form-control"
              @change="setBendahara()">
              <option value="">-- Pilih Kas Bank --</option>
              <option v-for="item in rekeningbank"
                :value="item.id"
                :key="item.id">
                {{ item.no_rekening }} - {{ item.nama_bank }}
              </option>
            </select>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Akun Bendahara</label>
            <input type="text" class="form-control" v-model="bendahara" readonly>
            <input type="hidden" name="bendahara" class="form-control" v-model="bendaharaId">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" cols="30" rows="5" required></textarea>
          </div>
        </div>
      </div>
    </div>

    <!-- berdasarkan skrd -->
    <div class="row" v-if="skrd_radio === 'with_skrd'">
      <div class="col-md-12">
        <div class="table-responsive pl-lg-4 pr-lg-4">
          <table class="table table-striped">
            <thead>
              <th>Nomor</th>
              <th>Tanggal</th>
              <th>Tanggal Tempo</th>
              <th>Nominal</th>
              <th>Nominal Denda</th>
              <th>Nominal Bayar TBP</th>
              <th>Sisa Piutang</th>
              <th>Jenis Pembayaran</th>
            </thead>
            <tbody>
              <tr v-for="(item, index) in skrd" :key="item.id">
                <td>
                  {{ item.nomor }}
                  <input type="hidden" name="skrd[]" :value="item.id">
                </td>
                <td>{{ item.tanggal }}</td>
                <td>-</td>
                <td>{{ item.nominal_idr }}</td>
                <td>-</td>
                <td>
                  <money name="nominal_bayar[]" class="form-control form-control-sm"
                    @input="setSisaPiutang(item, index)"
                    v-model="item.nominal_bayar"
                    v-bind="money"></money>
                </td>
                <td>{{ item.sisa_piutang | currency }}</td>
                <td>
                  <select name="jenis_pembayaran[]" class="form-control form-control-sm">
                    <option v-for="pembayaran in jenisPembayaran"
                      :key="pembayaran.id"
                      :value="pembayaran.id"
                      :selected="item.jenis_pembayaran_id == pembayaran.id">
                      {{ pembayaran.kode_jurnal }}
                    </option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>

          <div class="text-right mt-4">
            <p class="font-weight-500">Total : {{ total | currency }}</p>
          </div>
        </div>

      </div>
    </div>

    <!-- tidak berdasarkan skrd -->
    <div class="row" v-if="skrd_radio === 'no_skrd'">
      <div class="col-md-12">
        <div class="table-responsive pl-lg-4 pr-lg-4">
          <table class="table table-striped">
            <thead>
              <th>Nomor Objek</th>
              <th>Alamat</th>
              <th>Klasifikasi</th>
              <th>Nominal Tarif</th>
              <th>Nominal Bayar TBP</th>
              <th>Sisa Bayar</th>
              <th>Jenis Pembayaran</th>
            </thead>
            <tbody>
              <tr v-for="(item, index) in objectRetribusi" :key="item.id">
                <td>
                  {{ item.kode }}
                  <input type="hidden" name="object_retribusi[]" :value="item.id">
                </td>
                <td>{{ item.lokasi }}</td>
                <td>{{ item.tarif_retribusi.klasifikasi_pemakaian.jenis_klasifikasi }}</td>
                <td>{{ item.tarif | currency }}</td>
                <td>
                  <money name="nominal_bayar[]" class="form-control form-control-sm"
                    @input="setSisaBayar(item, index)"
                    v-model="item.nominal_bayar"
                    v-bind="money"></money>
                </td>
                <td>{{ item.sisa_bayar | currency }}</td>
                <td>
                  <select name="jenis_pembayaran[]" class="form-control form-control-sm" readonly>
                    <option v-for="pembayaran in jenisPembayaran" :key="pembayaran.id" :value="pembayaran.id">
                      {{ pembayaran.kode_jurnal }}
                    </option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>

          <div class="text-right mt-4">
            <p class="font-weight-500">Total : {{ total | currency }}</p>
          </div>

        </div>
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios'
import vmoney from '../../mixins/v-money'

let timeout = null // init timeout delay

export default {
  props: ['rekeningbank', 'jenispembayaran'],
  data () {
    return {
      skrd_radio: 'with_skrd',
      selectedPemakai: '',
      skrd: [],
      selectedObjectRetribusi: '',
      objectRetribusiOptions: [],
      objectRetribusi: [],
      tanggalTbp: null,
      pemakai: [],
      selectedRekening: '',
      bendahara: '',
      bendaharaId: null,
      query: "",
      search_data: [],
      isReadOnly: true
    }
  },
  async created () {
    try {
      if (this.skrd_radio === 'with_skrd') {
        const response = await axios.get(`/ajax/pemakai1`)
        this.pemakai = response.data
      }

      const bank = this.rekeningbank[0]
      this.selectedRekening = bank.id
      this.bendahara = `${bank.akun_bendahara.kode} - ${bank.akun_bendahara.nama}`
      this.bendaharaId = bank.akun_bendahara.id
    } catch (error) {
      console.log(error)
    }
  },
  computed: {
    total () {
      if (this.skrd_radio === 'with_skrd') {
        return this.skrd.reduce((total, item) => item.nominal_bayar + total, 0)
      } else if (this.skrd_radio === 'no_skrd') {
        return this.objectRetribusi.reduce((total, item) => item.nominal_bayar + total, 0)
      }

      return 0
    },
    totalPiutang () {
      return this.skrd.reduce((total, item) => item.nominal + total, 0)
    },
    jenisPembayaran () {
      if (this.skrd_radio === 'with_skrd') {
        return this.jenispembayaran.filter(item => item.kode_jurnal !== 'TBP-SA')
      } else if (this.skrd_radio === 'no_skrd') {
        return this.jenispembayaran.filter(item => item.kode_jurnal === 'TBP-SA')
      }

      return this.jenispembayaran
    }
  },
  methods: {
    getPemakaiData() {
      if(this.query == '' || this.tanggalTbp == '')
        return null;

      // reset selected pemakai & skrd
      this.selectedPemakai = ''
      this.skrd = []
      this.objectRetribusi = []

      clearTimeout(timeout);
      timeout = setTimeout(async () => {
        this.search_data = [];
        const response = await axios.get("/ajax/pemakai1", {
          params: {
            name: this.query,
            tanggal: this.tanggalTbp
          }
        })
        this.search_data = response.data
        this.pemakai = response.data
      }, 800);
    },
    getSelectedPemakai(data, e) {
      e.preventDefault()
      this.query = data.nama
      this.search_data = []
      this.selectedPemakai = data.id

      const pemakai = this.pemakai.filter(item => {
        return item.id === data.id
      })[0]

      /**
       * DISCLAIMER:
       * 
       * I don't understand why this code need 2x parseFloat
       * I've trying using 1x parseFloat, but the variable still as string
       * Lemme know if you know the reason why this is happened.
       */

      // WITH SKRD  
      this.skrd = [...pemakai.skrd]
      this.skrd.map(item => {
        item.nominal = parseFloat(parseFloat(item.nominal).toFixed(2))
        item.nominal_bayar = parseFloat(parseFloat(0.00).toFixed(2))
        item.sisa_piutang = parseFloat(parseFloat(item.nominal).toFixed(2))

        // set variable for auto select jenis pembayaran
        let currentYear = new Date().getFullYear()
        if (item.tahun == currentYear) {
          item.jenis_pembayaran_id = this.jenispembayaran.filter(item => {
            return item.kode_jurnal === 'TBP-OA'
          })[0].id
        } else {
          item.jenis_pembayaran_id = this.jenispembayaran.filter(item => {
            return item.kode_jurnal === 'TBP-PUTG'
          })[0].id
        }
      })

      // NO SKRD
      this.objectRetribusiOptions = [...pemakai.object_retribusi]
    },
    setObjectRetribusi () {
      const objectRetribusi = this.objectRetribusiOptions.filter(item => {
        return item.id == this.selectedObjectRetribusi
      })

      this.objectRetribusi = [...objectRetribusi]
      this.objectRetribusi.map(item => {
        let tarif = parseFloat(parseFloat(item.tarif).toFixed(2)) // convert string to number (float)
        let value = tarif * item.luas
        
        item.tarif = parseFloat(parseFloat(value).toFixed(2))
        item.nominal_bayar = parseFloat(parseFloat(0.00).toFixed(2))
        item.sisa_bayar = parseFloat(parseFloat(value).toFixed(2))
      })
    },
    setBendahara () {
      const bank = this.rekeningbank.filter(item => {
        return item.id === this.selectedRekening
      })[0]

      this.bendahara = `${bank.akun_bendahara.kode} - ${bank.akun_bendahara.nama}`
      this.bendaharaId = bank.akun_bendahara.id
    },
    setSisaPiutang (item, index) {
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        if (item.nominal_bayar > item.nominal) {
          item.sisa_piutang = 0.00
        } else {
          item.sisa_piutang = item.nominal - item.nominal_bayar
        }

        this.$set(this.skrd, index, item)
      }, 200)
    },
    setSisaBayar (item, index) {
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        if (item.nominal_bayar > item.tarif) {
          item.sisa_bayar = 0.00
        } else {
          item.sisa_bayar = item.tarif - item.nominal_bayar
        }

        this.$set(this.objectRetribusi, index, item)
      }, 200)
    },
    changeReadonly () {
      if (this.isReadOnly) {
        this.isReadOnly = false
      }else {
        this.isReadOnly = true
      }
    }
  },
  mixins: [vmoney]
}
</script>