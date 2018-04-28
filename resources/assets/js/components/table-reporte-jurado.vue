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
    <paginate
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
          titulo: '',
          link: 'ver detalles',
          url: 'jurado_detalles',
          mensaje: 'La cedula del tutor no esta registrada en el sistema',
      	  columns: ['principal_1','principal_2','suplente_1','suplente_2'],
      	  titulos: ['Principal 1','Principal 2','suplente 1','suplente 2','Ver Solicitud'],
          sortKey: ''
        }
      },
      components:{
    		tableOrder
      },
      beforeMount () {
        let name = document.getElementById('idName').value
      	this.$http.get('/api/resultados_jurado/'+name).then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {
  		    	  let tema = {
                id: value.solicitud_jurado_id+'/'+value.jurado_id+'/'+value.proyecto_id,
                principal_1: value.principal_1,
                principal_2: value.principal_2,
                suplente_1: value.suplente_1,
                suplente_2: value.suplente_2,
                solicitud_jurado_id: value.solicitud_jurado_id,
                jurado_id: value.jurado_id,
                proyecto_id: value.proyecto_id,
                idPdf: value.proyecto,
                nombre_estudiante: value.nombre_estudiante
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
      },
      methods: {
        functionName: function(pageNum) {
          let name = document.getElementById('idName').value
          this.$http.get('/api/resultados_jurado/'+name+'?page='+pageNum).then(response => {
            // get body data
            let datos = []
          if (response) {
            response.body.data.forEach(function (value, i) {
              let tema = {
                id: value.solicitud_jurado_id+'/'+value.jurado_id+'/'+value.proyecto_id,
                principal_1: value.principal_1,
                principal_2: value.principal_2,
                suplente_1: value.suplente_1,
                suplente_2: value.suplente_2,
                idPdf: value.proyecto,
                nombre_estudiante: value.nombre_estudiante
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
        }
      }
    }
</script>