import Vue from 'vue'
import { Money } from 'v-money'
import VueCurrencyFilter from 'vue-currency-filter'
 
Vue.use(VueCurrencyFilter, {
  symbol : '',
  thousandsSeparator: '.',
  fractionCount: 2,
  fractionSeparator: ',',
  symbolPosition: 'front',
  symbolSpacing: true
})

export default {
  components: {
    Money
  },
  data () {
    return {
      money: {
        decimal: ',',
        thousands: '.',
        prefix: '',
        suffix: '',
        precision: 2,
        masked: false
      }
    }
  }
}