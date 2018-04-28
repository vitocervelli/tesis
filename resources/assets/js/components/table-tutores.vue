<template>
  <div>  
    <table-order :data="data"
      :columns="columns"
      :titulos="titulos"
      :titulo="titulo"
      :link="link"
      :url="url"
      :total="15"
      :perPage="5"
      :indice="1"
      :mensaje="mensaje"
      :filterKey="filterKey">
    </table-order>
    <paginate v-if="total>1"
      :page-count="total"
      :click-handler="functionName"
      :prev-text="'«'"
      :next-text="'»'"
      :container-class="'pagination'"
      :page-class="'page-item'"
      :page-link-class="'page-link'"
      :prev-class="'page-item'"
      :prev-link-class="'page-link'"
      :next-class="'page-item'"
      :next-link-class="'page-link'">
    </paginate>
  </div>
</template>

<script>
	import tableOrder from './table-order.vue'
    export default {
      data () {
        return {
          data: Object,
          total: 0,
          filterKey: '',
          titulo: 'Por favor seleccione a un profesor de la lista',
          link: 'seleccione',
          url: './solicitar_tutor/enviar',
          mensaje: 'No hay tutores',
      	  columns: ['nombre','linea_investigacion'],
      	  titulos: ['Profesor','Linea de investigación','Seleccione'],
          sortKey: ''
        }
      },
      components:{
		tableOrder
      },
      beforeMount () {
      	this.$http.get('/api/tutores').then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
            response.body.data.forEach(function (value, i) {
              let linea = ''
              if(value.lineas){
    		    	    value.lineas.forEach(function (line) {
                  linea = `${linea} ${line.linea_investigacion}`
                })
              }
		    	  let tema = {
			    	  linea_investigacion : linea,
			    	  id: value.id,
			    	  nombre: value.nombre.toLowerCase() + ' ' + value.apellido
		    	  }
		    	  datos.push(tema)
		        },this)
            this.data = datos
            this.total = Math.ceil(response.body.total/response.body.per_page)
  		    }

  		    console.log(response.body)
  		  }, response => {
  		    // error callback
  		    console.log(response)
  		  });
      },
      methods: {
        functionName: function(pageNum) {
          this.$http.get('/api/tutores?page='+pageNum).then(response => {
          // get body data
          let datos = []
          let linea = ''
          if (response) {
            response.body.data.forEach(function (value, i) {
              let linea = ''
              if(value.lineas){
                  value.lineas.forEach(function (line) {
                  linea = `${linea} ${line.linea_investigacion}`
                })
              }
              let tema = {
                linea_investigacion : linea,
                id: value.id,
                nombre: value.nombre.toLowerCase() + ' ' + value.apellido
              }
              datos.push(tema)
            },this)
            this.data = datos
            this.total = Math.ceil(response.body.total/response.body.per_page)
          }
        }, response => {
          // error callback
          console.log(response)
        });
          console.log(pageNum)
        }
      }
    }
</script>