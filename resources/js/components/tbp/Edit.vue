<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Nomor</label>
            <input type="text" class="form-control" name="nomor" v-model="tbp.nomor" :readonly="isChecked">
            <input type="checkbox" name="nomor_auto" @click="changeReadonly" :checked="isChecked"/> Penomoran otomatis
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div>
          <div class="form-group">
            <label class="form-control-label">Tanggal SKRD</label>
            <input
              type="date"
              data-date=""
              data-date-format="DD MMMM YYYY"
              v-model="tanggal"
              name="tanggal"
              readonly
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
            <div class="custom-control custom-radio">
              <input v-model="skrd_radio"
                type="radio" id="radioNoSkrd" name="skrd_radio" class="custom-control-input" value="no_skrd">
              <label class="custom-control-label" for="radioNoSkrd">Tidak Berdasarkan SKRD</label>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="pl-lg-4">
          <div class="form-group">
          <label class="form-control-label">Pemakai</label>
          <input
            type="text"
            placeholder="Masukkan nama pemakai"
            v-model="query"
            @keyup="getPemakaiData()"
            autocomplete="off"
            class="form-control input-lg"
            readonly
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
        class="col-md-4">
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
            <textarea v-model="keterangan" name="keterangan" class="form-control" cols="30" rows="5" required></textarea>
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
              <tr v-for="(item, index) in tbpDetail" :key="item.id">
                <td>
                  {{ item.skrd.nomor }}
                  <input type="hidden" name="skrd[]" :value="item.skrd.id">
                </td>
                <td>{{ item.skrd.tanggal }}</td>
                <td>-</td>
                <td>{{ item.skrd.nominal_idr }}</td>
                <td>-</td>
                <td>
                  <money name="nominal_bayar[]" class="form-control form-control-sm"
                    @input="setSisaPiutang(item, index)"
                    v-model="item.skrd.nominal_bayar"
                    v-bind="money"
                    :readonly="item.skrd.is_readonly"></money>
                </td>
                <td>{{ item.skrd.sisa_piutang | currency }}</td>
                <td>
                  <select v-model="item.jenis_pembayaran_id" name="jenis_pembayaran[]" class="form-control form-control-sm"
                    :readonly="item.skrd.is_readonly">
                    <option v-for="pembayaran in jenisPembayaran"
                      :key="pembayaran.id"
                      :value="pembayaran.id">
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
                    <option v-for="item in jenisPembayaran" :key="item.id" :value="item.id">
                      {{ item.kode_jurnal }}
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
  props: ['tbp', 'rekeningbank', 'jenispembayaran'],
  data () {
    return {
      tbpDetail: [],
      skrd_radio: 'with_skrd',
      tanggal: '',
      keterangan: '',
      selectedPemakai: '',
      skrd: [],
      selectedObjectRetribusi: '',
      objectRetribusiOptions: [],
      objectRetribusi: [],
      pemakai: [],
      selectedRekening: '',
      bendahara: '',
      bendaharaId: null,
      query: "",
      search_data: [],
      isChecked: false
    }
  },
  async created () {
    try {
      const response = await axios.get(`/ajax/pemakai`, {
        params: {
          name: this.tbp.pemakai.nama
        }
      })
      this.pemakai = response.data

      // prefilled form
      if (this.tbp.jenis === 'skrd') {
        this.skrd_radio = 'with_skrd'
      } else {
        this.skrd_radio = 'no_skrd'
      }

      if (this.tbp.nomor_otomatis) {
        this.isChecked = true
      } else {
        this.isChecked = false
      }

      this.tbpDetail = [...this.tbp.tbp_detail]
      this.tanggal = this.tbp.tanggal
      this.selectedRekening = this.tbp.rekening_bank_id
      this.setBendahara()
      this.keterangan = this.tbp.keterangan

      this.query = this.tbp.pemakai.nama
      this.selectedPemakai = this.tbp.pemakai_id
      this.getSelectedPemakai(this.tbp.pemakai, event)

      if (this.tbp.jenis === 'skrd') {
        this.skrd = []
        this.tbpDetail.map(item => {
          let nominal = parseFloat(parseFloat(item.skrd.nominal).toFixed(2));
          let bayar = parseFloat(parseFloat(item.nominal).toFixed(2));

          item.skrd.nominal = parseFloat(parseFloat(item.skrd.nominal).toFixed(2))
          item.skrd.nominal_bayar = parseFloat(parseFloat(item.nominal).toFixed(2))
          item.skrd.sisa_piutang = parseFloat(parseFloat(nominal - bayar).toFixed(2))
          item.skrd.is_readonly = item.skrd.nominal == item.skrd.nominal_bayar
        })
      } else {
        this.selectedObjectRetribusi = this.tbp.tbp_detail[0].objek_retribusi_id
        this.objectRetribusi = [this.tbp.tbp_detail[0].object_retribusi]
        this.objectRetribusi.map(item => {
          let tarif = parseFloat(parseFloat(item.tarif).toFixed(2)) // convert string to number (float)
          let value = tarif * item.luas
          
          item.tarif = parseFloat(parseFloat(value).toFixed(2))
          item.nominal_bayar = parseFloat(parseFloat(this.tbp.tbp_detail[0].nominal).toFixed(2))
          item.sisa_bayar = parseFloat(parseFloat(value).toFixed(2))
        })
      }
    } catch (error) {
      console.log(error)
    }
  },
  computed: {
    total () {
      if (this.skrd_radio === 'with_skrd') {
        let total = 0;
        for (let i = 0; i < this.tbpDetail.length; i++) {
          total += this.tbpDetail[i].skrd.nominal_bayar
        }
        return total
      } else if (this.skrd_radio === 'no_skrd') {
        return this.objectRetribusi.reduce((total, item) => item.nominal_bayar + total, 0)
      }

      return 0
    },
    totalPiutang () {
      let total = 0;
      for (let i = 0; i < this.tbpDetail.length; i++) {
        total += this.tbpDetail[i].skrd.sisa_piutang
      }

      return total
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
      // reset selected pemakai & skrd
      this.selectedPemakai = ''
      this.skrd = []
      this.objectRetribusi = []

      clearTimeout(timeout);
      timeout = setTimeout(async () => {
        this.search_data = [];
        const response = await axios.get("/ajax/pemakai", {
          params: {
            name: this.query
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
        if (item.skrd.nominal_bayar > item.skrd.nominal) {
          item.skrd.sisa_piutang = 0.00
        } else {
          item.skrd.sisa_piutang = item.skrd.nominal - item.skrd.nominal_bayar
        }

        this.$set(this.tbpDetail, index, item)
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
      this.isChecked = !this.isChecked
    }
  },
  mixins: [vmoney]
}
</script>