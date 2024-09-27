<template>
  <div>
    <div class="pl-lg-4 pr-lg-4">
      <div class="form-group">
        <label class="form-control-label">Tarif retribusi</label>
        <select
          name="tarif_retribusi"
          class="form-control"
          @change="getKlasifikasiPemakaian($event); getNominal()"
          v-model="selectedTarif"
        >
          <option value>Pilih tarif retribusi</option>
          <option
            v-for="tarif in tarifretribusi"
            :key="tarif.id"
            :value="tarif.id"
          >{{ tarif.klasifikasi_pemakaian.jenis_klasifikasi }} | {{ tarif.range_njop }}</option>
        </select>
      </div>
    </div>
    <div class="pl-lg-4 pr-lg-4" v-if="showKlasifikasiPemakaian">
      <div class="form-group">
        <label class="form-control-label">Klasifikasi pemakaian</label>
        <p>{{ klasifikasiPemakaian.klasifikasi_pemakaian.jenis_klasifikasi }}</p>
      </div>
    </div>
    <div class="pl-lg-4 pr-lg-4" v-if="showKlasifikasiPemakaian">
      <div class="form-group">
        <label class="form-control-label">Tarif M2</label>
        <p>{{ klasifikasiPemakaian.tarif_meter }}</p>
      </div>
    </div>
    <div class="pl-lg-4 pr-lg-4">
      <div class="form-group">
        <label class="form-control-label">Luas / m2</label>
        <input type="text" class="form-control" name="luas" @change="getNominal()" v-model="luas" min="0"/>
      </div>
    </div>

    <div class="pl-lg-4 pr-lg-4">
      <div class="form-group">
        <label class="form-control-label">Nominal tarif</label>
        <money name="tarif" class="form-control form-control" readonly
                    v-model="nominalTarifObject"
                    v-bind="money"></money>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios"
import vmoney from '../mixins/v-money'

let timeout = null;
export default {
  created() {
    if (this.action == "edit") {
      this.showKlasifikasiPemakaian = true;
      this.klasifikasiPemakaian = this.tarifretribusi;
      this.selectedTarif = this.tarif_retribusi_id;
      this.klasifikasiPemakaian = this.detail_tarif_retribusi;
      this.luas = this.object_retribusi.luas
      this.nominalTarifRetribusi = this.klasifikasiPemakaian.tarif_meter_float
      this.nominalTarifObject = this.object_retribusi.luas * this.klasifikasiPemakaian.tarif_meter_float
    }
  },
  data() {
    return {
      showKlasifikasiPemakaian: false,
      klasifikasiPemakaian: null,
      selectedTarif: "",
      nominalTarifRetribusi: 0,
      nominalTarifObject: 0,
      luas: 0
    };
  },
  methods: {
    async getKlasifikasiPemakaian(event) {
      try {
        const response = await axios.get(
          "/ajax/tarif-retribusi/" + event.target.value
        );
        this.klasifikasiPemakaian = response.data;
        this.showKlasifikasiPemakaian = true;
        this.nominalTarifRetribusi = response.data.tarif_meter_float;
      } catch (e) {
        console.log(e);
      }
    },
    getNominal() {
      //clear selected pemakai, alamat & object retribusi
      this.nominalTarifObject = 0
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        const luas = this.luas
        this.nominalTarifObject = luas  * parseFloat(parseFloat(this.nominalTarifRetribusi))
        console.log(this.nominalTarifRetribusi)
        console.log(this.nominalTarifObject)
      }, 800);
    },
  },
  props: [
    "tarifretribusi",
    "action",
    "tarif_retribusi_id",
    "klasifikasi_pemakaian",
    "detail_tarif_retribusi",
    "object_retribusi"
  ],
  mixins: [vmoney]
};
</script>
