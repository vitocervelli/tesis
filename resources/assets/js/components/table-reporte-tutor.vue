<template>
  <div>  
    <table-order :data="data"
      :columns="columns"
      :titulos="titulos"
      :titulo="titulo"
      :link="link"
      :url="url"
      :linkPdf="linkPdf"
      :urlPdf="urlPdf"
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
          titulo: '',
          link: 'ver solicitud',
          linkPdf: 'ver proyecto',
          url: '../jurado/detalle_solicitud_jurado',
          urlPdf: '..',
          mensaje: 'La cedula del tutor no esta registrada en el sistema',
      	  columns: ['nombre_estudiante','titulo_proyecto'],
      	  titulos: ['Estudiante','Proyecto','Ver Proyecto','Ver Solicitud'],
          sortKey: ''
        }
      },
      components:{
    		tableOrder
      },
      beforeMount () {
        let id = document.getElementById('idTutor').value
      	this.$http.get('/api/resultados_tutor/'+id).then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {
  		    	  let tema = {
                id: value.solicitud_id,
                titulo_proyecto: value.titulo_proyecto,
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
          let id = document.getElementById('idTutor').value
          this.$http.get('/api/resultados_tutor/'+id+'?page='+pageNum).then(response => {
            // get body data
            let datos = []
            if (response) {
              response.body.data.forEach(function (value, i) {
                let tema = {
                  id: value.id+'/'+value.tutor_id,
                  titulo_proyecto: value.titulo_proyecto,
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