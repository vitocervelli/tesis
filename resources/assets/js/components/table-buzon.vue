<template>
  <div>  
    <table-order :data="data"
      :columns="columns"
      :titulos="titulos"
      :titulo="titulo"
      :link="link"
      :url="url"
      :mensaje="mensaje">
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
          titulo: 'Buzon de notificaciones',
          link: 'ver notificación',
          url: '.',
          mensaje: 'No hay notificaciones',
      	  columns: ['fecha','nombre','tipo'],
      	  titulos: ['Fecha','De','Tipo de notificación','Ver notificación'],
          sortKey: ''
        }
      },
      components:{
    		tableOrder
      },
      beforeMount () {
      	this.$http.get('/api/buzon').then(response => {
  		    // get body data
  		    let datos = []
          let is_tutor = 0
          let nombre = ''
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {
              if (value.nombre_estudiante) {
                is_tutor = 1
                nombre = value.nombre_estudiante.toLowerCase() + ' ' + value.apellido_estudiante
              }
              if (value.nombre_tutor) {
                is_tutor = 1
                nombre = value.nombre_tutor.toLowerCase() + ' ' + value.apellido_tutor
              }

  		    	  let item = {
  			    	  fecha : value.fecha.toLowerCase(),
                tipo: value.tipo,
                nombre: nombre,
  			    	  id: value.url.replace(window.location.origin+'/','')
  		    	  }
  		    	  datos.push(item)
		        },this)
            this.data = datos
		        this.total = Math.ceil(response.body.total/response.body.per_page)
            if(!is_tutor){
              this.columns = ['fecha','tipo']
              this.titulos = ['Fecha','Tipo de notificación','Ver notificación']
            }
  		    }

  		    console.log(response.body)
  		  }, response => {
  		    // error callback
  		    console.log(response)
  		  });
      },
      methods: {
        functionName: function(pageNum) {
          this.$http.get('/api/buzon?page='+pageNum).then(response => {
            // get body data
            let datos = []
            let is_tutor = 0
            let nombre = ''
            if (response) {
              response.body.data.forEach(function (value, i) {
                if (value.nombre_estudiante) {
                  is_tutor = 1
                  nombre = value.nombre_estudiante.toLowerCase() + ' ' + value.apellido_estudiante
                }
                if (value.nombre_tutor) {
                  is_tutor = 1
                  nombre = value.nombre_tutor.toLowerCase() + ' ' + value.apellido_tutor
                }

                let item = {
                  fecha : value.fecha.toLowerCase(),
                  tipo: value.tipo,
                  nombre: nombre,
                  id: value.url.replace(window.location.origin+'/','')
                }
                datos.push(item)
              },this)
              this.data = datos
              this.total = Math.ceil(response.body.total/response.body.per_page)
              if(!is_tutor){
                this.columns = ['fecha','tipo']
                this.titulos = ['Fecha','Tipo de notificación','Ver notificación']
              }
            }

            console.log(response.body)
          }, response => {
            // error callback
            console.log(response)
          });
        }
      }
    }
</script>