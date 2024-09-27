<template>
  <div>
    <div class="row">
      <div class="col-md-4">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Nomor Surat Izin</label>
            <input type="text" class="form-control" name="nomor_izin">
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div>
          <div class="form-group">
            <label class="form-control-label">Tanggal Izin</label>
            <input
              type="date"
              data-date=""
              data-date-format="DD MMMM YYYY"
              :value="currentdate"
              name="tanggal_izin"
              class="form-control datePicker">
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Nama Pemakai</label>
            <input type="text" class="form-control" name="pemakai">
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">Nama Objek</label>
          <input type="text" class="form-control" name="nama_objek">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Alamat Objek</label>
            <textarea name="alamat_objek" class="form-control" cols="30" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-2">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Tarif</label>
            <money
              class="form-control"
              :value="tarif"
              name="tarif"
              v-model="tarif"
              v-bind="money">
            </money>
          </div>
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label class="form-control-label">Tinggi (m)</label>
          <input type="text" class="form-control" name="tinggi" v-model="tinggi">
        </div>
      </div>

      <div class="col-md-2">
        <div class="form-group">
          <label class="form-control-label">Luas (m)</label>
          <input type="text" class="form-control" name="luas" v-model="luas">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="pl-lg-4">
          <div class="form-group">
            <label class="form-control-label">Tarif Bayar</label>
            <money
              class="form-control"
              :value="tarifBayar"
              name="tarif_bayar"
              readonly="0">
            </money>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label class="form-control-label">Jenis Pembayaran</label>
          <input type="text" class="form-control"
            :value="jenisPembayaran.kode_jurnal" readonly="true">
          <input type="hidden" name="jenis_pembayaran" :value="jenisPembayaran.id">
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

  </div>
</template>

<script>
import axios from 'axios'
import vmoney from '../../mixins/v-money'

export default {
  props: ['currentdate', 'rekeningbank', 'jenispembayaran'],
  data () {
    return {
      tarif: 75000.00,
      tinggi: 0,
      luas: 0,
      selectedRekening: '',
      bendahara: '',
      bendaharaId: null,
    }
  },
  async created () {
    try {
      const bank = this.rekeningbank[0]
      this.selectedRekening = bank.id
      this.bendahara = `${bank.akun_bendahara.kode} - ${bank.akun_bendahara.nama}`
      this.bendaharaId = bank.akun_bendahara.id
    } catch (error) {
      console.log(error)
    }
  },
  computed: {
    jenisPembayaran () {
      return this.jenispembayaran.filter(item => item.kode_jurnal === 'TBP-SA')[0]
    },
    tarifBayar () {
      return this.tarif * this.luas * this.tinggi
    }
  },
  methods: {
    setBendahara () {
      const bank = this.rekeningbank.filter(item => {
        return item.id === this.selectedRekening
      })[0]

      this.bendahara = `${bank.akun_bendahara.kode} - ${bank.akun_bendahara.nama}`
      this.bendaharaId = bank.akun_bendahara.id
    }
  },
  watch: {
    tinggi (newValue) {
      if (! newValue) {
        this.tinggi = 0
      } else {
        this.tinggi = parseInt(newValue)
      }
    },
    luas (newValue) {
      if (! newValue) {
        this.luas = 0
      } else {
        this.luas = parseInt(newValue)
      }
    }
  },
  mixins: [vmoney]
}
</script>