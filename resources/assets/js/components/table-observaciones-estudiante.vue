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
          titulo: 'Observaciones realizadas al estudiante ',
          link: 'ver detalles',
          url: '../ver',
          mensaje: 'Hasta el momento no tienes ningún Estudiante asignado',
      	  columns: ['fecha_observaciones','observaciones'],
      	  titulos: ['Fecha de observación','Observación','Ver detalles'],
          sortKey: ''
        }
      },
      components:{
		tableOrder
      },
      beforeMount () {

        let v = window.location.pathname
        v=v.replace('/observaciones/ver_estudiante','/api/observaciones')
      	this.$http.get(v).then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {
              let tema = {
                id: value.id,
                fecha_observaciones: value.fecha_observaciones,
                observaciones: value.observaciones
              }
              datos.push(tema)
              this.titulo = 'Observaciones realizadas al estudiante ' + value.estudiante_nombre + ' ' + value.estudiante_apellido
		        },this)
            this.data = datos
            this.total = Math.ceil(response.body.total/response.body.per_page)
  		    }
  		  }, response => {
  		    // error callback
  		    console.log(response)
  		  });
      },
      methods: {
        functionName: function(pageNum) {
          let v = window.location.pathname
          v=v.replace('/observaciones/ver_estudiante','/api/observaciones')
          this.$http.get(v+'?page='+pageNum).then(response => {
            // get body data
            let datos = []
            if (response) {
              response.body.data.forEach(function (value, i) {
                let tema = {
                  id: value.estudiante_id,
                  fecha_observaciones: value.fecha_observaciones,
                  observaciones: value.observaciones
                }
                datos.push(tema)
                this.titulo = 'Observaciones realizadas al estudiante ' + value.estudiante_nombre + ' ' + value.estudiante_apellido
              },this)
              this.data = datos
              this.total = Math.ceil(response.body.total/response.body.per_page)
            }
          }, response => {
            // error callback
            console.log(response)
          });
        }
      }
    }
</script>