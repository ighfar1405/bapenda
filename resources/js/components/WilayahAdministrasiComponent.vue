<template>
  <div>
    <div class="pl-lg-4 pr-lg-4">
      <div class="form-group">
        <label class="form-control-label">Kecamatan</label>
        <select name="kecamatan" class="form-control" @change="getKelurahan($event)" v-model="selectedKecamatan">
          <option value="">Pilih kecamatan</option>
          <option v-for="kec in kecamatan" :key="kec.id" :value="kec.id" >{{ kec.nama }}</option>
        </select>
      </div>
    </div>
    <div class="pl-lg-4 pr-lg-4" v-if="showKelurahan">
      <div class="form-group">
        <label class="form-control-label">Kelurahan</label>
        <select name="kelurahan" class="form-control" id="kelurahan" v-model="selectedKelurahan">
          <option value="">Pilih kelurahan</option>
          <option v-for="kel in kelurahan" :key="kel.id" :value="kel.id">{{ kel.nama }}</option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  created() {
    if(this.action == 'edit'){
      this.showKelurahan = true
      this.kelurahan = this.list_kelurahan
      this.selectedKecamatan = this.kecamatan_id
      this.selectedKelurahan = this.kelurahan_id
    }
  },
  data() {
    return {
      showKelurahan: false,
      kelurahan: null,
      selectedKecamatan: '',
      selectedKelurahan: ''
    };
  },
  methods: {
    async getKelurahan(event) {
      try {
        const response = await axios.get(
          "/ajax/kelurahan/"+event.target.value 
        );
        this.kelurahan =  response.data
        this.showKelurahan =  true
      } catch (e) {
        console.log(e);
      }
    }
  },
  props: ["kecamatan", "kelurahan_id", "kecamatan_id", "action", "list_kelurahan"]
};
</script>
