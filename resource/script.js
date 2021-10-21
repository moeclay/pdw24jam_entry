// initial vuejs
const baseapi = "https://pandawa24jam.com/mutasi/";

// homepage
const Home = Vue.component('homepage', {
	template: '#homepage',
	data() {
		return {
            listmutasi: []
		}
	},
	methods: {
        loadData: function(){
            axios.get(baseapi+"apicredit")
            .then((response) => {
                this.listmutasi = response.data;
            });
        },
        formatRupiah: function(angka, prefix){
            split  = angka.split('.'),
            sisa   = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah;
        },
        unixDate: function(numunix){
            var a = new Date(numunix * 1000);
            var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var year = a.getFullYear();
            var month = months[a.getMonth()];
            var date = a.getDate();
            var hour = a.getHours();
            var min = a.getMinutes();
            var sec = a.getSeconds();
            var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
            return time;
        },
        bcaCredit: function(){
            axios.get(baseapi+"apibank/bca/credit")
            .then((response) => {
                this.listmutasi = response.data;
            });
            console.log('success bca credit');
        },
        briCredit: function(){
            axios.get(baseapi+"apibank/bri/credit")
            .then((response) => {
                this.listmutasi = response.data;
            });
            console.log('success bri credit');
        }
    },
    mounted(){
    	this.loadData();
    }
});

// infopage
const InfoRekening = Vue.component('infopage', {
	template: '#infopage',
	data() {
		return {
            listbank: []
		}
	},
	methods: {
        loadData: function(){
            axios.get(baseapi+"infoRekening")
            .then((response) => {
                this.listbank = response.data;
                console.log(response.data);
            });
        },
        formatRupiah: function(angka, prefix){
            split  = angka.split('.'),
            sisa   = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if(ribuan){
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah;
        }
    },
    mounted(){
    	this.loadData();
    }
});

// set router
const routes = [
	{ path: '/', component: Home },
	{ path: '/info', component: InfoRekening },
];
const router = new VueRouter({
	routes
});
// initial vuejs
var app = new Vue({
	el: '#app',
	data: {
	  title: 'Cek Mutasi Bank',
      subtitle: 'pandawa24jam digital printing',  
	},
	router: router
});