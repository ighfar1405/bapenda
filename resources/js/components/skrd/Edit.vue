<template>
  <div class="container"> 
   <div class="row">
      <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label">Nomor</label>
            <input type="text" name="nomor" class="form-control"  v-bind:readonly="isReadOnly" v-model="nomor" />
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="form-control-label">Tanggal penetapan SKRD</label>
          <input type="date" name="tanggal_penetapan" v-model="tanggalPenetapan" class="form-control" data-date-format="YYYY MMMM DD">
      </div>
    </div>
   </div>
   <div class="row">
     <div class="col-md-6">
      <div class="form-group">
        <label class="form-control-label">Pemakai</label>
        <input
          type="text"
          placeholder="Masukkan nama pemakai"
          v-model="query"
          @keyup="getData()"
          autocomplete="off"
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
            >{{ item.nama }}</a>
          </ul>
      </div>
      </div>
     </div>
     <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label">Tanggal jatuh tempo</label>
             <input type="date" name="tanggal_jatuhtempo" v-model="tanggalJatuhTempo" class="form-control" data-date-format="YYYY MMMM DD">
          </div>
     </div>
   </div>
   <div class="row">
   <div class="col-md-6">
     <div class="form-group">
        <label class="form-control-label">Objek retribusi</label>
        <select name="object_retribusi" class="form-control" v-model="selectedIdObjectRetribusi" @change="getSelectedObjectRetribusi">
          <option value="">Pilih objek retribusi</option>
          <option v-for="(item) in objectRetribusi" 
            :key="item.id" 
            :value="item.id">
              {{ item.kode+' - '+item.lokasi }}
            </option>
        </select>
     </div>
   </div>
    <div class="col-md-6">
        <div class="form-group">
          <label class="form-control-label">Alamat</label>
          <input type="text" name="" class="form-control" readonly v-model="selectedAlamat">
        </div>
    </div>
   </div>
  
  <div class="row">
    <div class="col-md-12">
        <div class="form-group">
          <label class="form-control-label">Keterangan</label>
          <textarea name="keterangan" class="form-control" cols="30" rows="5" v-model="keterangan">
          </textarea>
        </div>
    </div>
  </div>
  <div class="row" v-if="selectedIdObjectRetribusi">
    <div class="col-md-12">
      <div class="form-group">
        <div class="table-responsive pl-lg-4 pr-lg-4">
          <table class="table table-striped">
            <thead>
              <th>Range Njop</th>
              <th>Lokasi</th>
              <th>Total tarif</th>
            </thead>
            <tbody>
              <tr>
                <td>
                <input type="hidden" name="object_retribusi" :value="selectedObjectRetribusi.id">
                  <a href="#" data-toggle="modal" data-target="#modalDetail" @click="showModalDetail(selectedObjectRetribusi, $event)">{{ selectedObjectRetribusi.tarif_retribusi.range_njop  }}</a>
                </td>
                <td>{{ selectedObjectRetribusi.lokasi }}</td>
                
                <td class="td-nominal">
                    <money class="form-control" name="nominal"
                      :readonly="true"
                      v-model="nominalBayar"
                      v-bind="money"></money>
                </td>
              </tr>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" ref="vuemodal">
  <div class="modal-dialog modal-lg" role="document" v-if="itemModal">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"  @click="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-responsive">
           <thead>
              <th>Kode objek</th>
              <th>Lokasi</th>
              <th>Luas Objek</th>
              <th>Range Njop Tarif Retribusi</th>
              <th>Tarif m2</th>
              <th>Tarif objek retribusi</th>
              <th>Opsi</th>
            </thead>
             <tbody>
              <tr>
                <td>{{ itemModal.kode  }}</td>
                <td>{{ itemModal.lokasi }}</td>
                <td>{{ itemModal.luas }} m</td>
                <td v-if="isEditableTarif">
                  <select @change="changeTarifRetribusi($event)" class="form-control">
                    <option v-for="(item) in list_tarif_retribusi" 
                    :key="item.id" 
                    :value="item.id">
                      {{ item.range_njop+' - '+item.klasifikasi_pemakaian.jenis_klasifikasi  }}
                    </option>
                  </select>
                </td>
                <td v-else>{{ itemModal.tarif_retribusi.range_njop }} -{{ itemModal.tarif_retribusi.klasifikasi_pemakaian.jenis_klasifikasi }} </td>
                <td>{{ itemModal.tarif_retribusi.tarif_meter }}</td>
                <td>
                  {{ itemModal.tarif_retribusi.tarif_meter_float * itemModal.luas | currency }}
                </td>
              
                <td>
                  <button class="btn btn-sm btn-warning" @click="editNominalObjectRetribusi($event)">
                    <i class="fa fa-edit"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" @click="simpanTarifBaru($event)" v-if="isEditableTarif">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeModal()">Close</button>
      </div>
    </div>
  </div>
</div>
  </div>
</template>
<script>
import vmoney from '../../mixins/v-money'
let timeout = null;
export default {
  props: ["list_object_retribusi", "skrd", "list_tarif_retribusi"],
  data() {
    return {
      tanggalJatuhTempo: null,
      tanggalPenetapan: null,
      query: "",
      search_data: [],
      selectedPemakai: null,
      selectedAlamat: '',
      objectRetribusi: [],
      itemModal: null,
      isReadOnly: true,
      selectedIdObjectRetribusi: '',
      selectedObjectRetribusi: null,
      nominalBayar: 0.00,
      nominalBayar: 0.00,
      isEditableTarif: false,
      newTarifObjectRetribusi: 0.00,
      keterangan: '',
      nomor: '',
      newKelasTarifRetribusi: '',
      newGolonganTarifRetribusi: '',
      allTarifRetribusi: null,
      newTarifRetribusi: null
    };
  },
  created() {
      this.selectedIdObjectRetribusi = this.skrd.object_retribusi_id
      this.objectRetribusi = this.list_object_retribusi
      this.selectedObjectRetribusi = this.skrd.object_retribusi
      this.tanggalJatuhTempo = this.skrd.jatuh_tempo
      this.tanggalPenetapan = this.skrd.tanggal_ori
      this.keterangan = this.skrd.keterangan
      this.nominalBayar = this.skrd.nominal_idr
      this.nomor = this.skrd.nomor
      this.getSelectedPemakai(this.skrd.pemakai)
      this.allTarifRetribusi = this.list_tarif_retribusi
  },
  methods: {
    getData() {
      //clear selected pemakai, alamat & object retribusi
      this.selectedPemakai = ''
      this.selectedAlamat = ''
      this.objectRetribusi = []
      clearTimeout(timeout);
      timeout = setTimeout(() => {
        this.search_data = [];
        axios
          .get("/ajax/pemakai", {
            params: {
              name: this.query
            }
          })
          .then(response => {
            this.search_data = response.data
          });
      }, 800);
    },
    getSelectedPemakai(data, e = null) {
      if (e){
        e.preventDefault()
        this.objectRetribusi = data.object_retribusi
      }
      this.query = data.nama
      this.search_data = []
      this.selectedPemakai = data.id
      this.selectedAlamat = data.alamat

      this.objectRetribusi.map(item => {
        if (this.skrd.object_retribusi_id == item.id){
          item.nominal = parseFloat(parseFloat(this.skrd.nominal).toFixed(2))
        }else {
          item.nominal = parseFloat(parseFloat(0.00).toFixed(2))
        }
      })
    },
    showModalDetail(item, e){
      e.preventDefault()
      this.itemModal = item
      this.newKelasTarifRetribusi = item.tarif_retribusi.kelas
      this.newGolonganTarifRetribusi = item.tarif_retribusi.golongan
    },
    changeReadonly() {
      if (this.isReadOnly) {
        this.isReadOnly = false
      }else {
        this.isReadOnly = true
      }
    },
    getSelectedObjectRetribusi(){
      const objectRetribusi = this.objectRetribusi.filter(item => {
        return item.id === this.selectedIdObjectRetribusi
      })[0]

      this.selectedObjectRetribusi = objectRetribusi
    },
    editNominalObjectRetribusi(e) {
      e.preventDefault()
      this.isEditableTarif = true
    },
    cancelEditTarif(e){
      e.preventDefault()
      this.isEditableTarif = false
    },
    changeTarifRetribusi(event){
      const newTarifRetribusi = this.allTarifRetribusi.filter(item => {
        return item.id == event.target.value
      })[0]

      this.newTarifRetribusi = newTarifRetribusi
      this.itemModal.tarif_retribusi = newTarifRetribusi
      this.nominalBayar = newTarifRetribusi.tarif_meter_float * this.itemModal.luas
      this.selectedObjectRetribusi.tarif_retribusi = newTarifRetribusi

    },
    async simpanTarifBaru(event){
      try {
        const response = await axios.put('/ajax/object-retribusi/' + this.selectedObjectRetribusi.id,{
          tarif: this.newTarifRetribusi.id,
        });

        this.isEditableTarif = false
      } catch (e) {
        console.log(e);
      }
    
    }
  },
  mixins: [vmoney]
}
</script>
<style scoped>
.mx-datepicker{
  display: block;
}
.td-nominal{
  width:200px !important;
}

</style>