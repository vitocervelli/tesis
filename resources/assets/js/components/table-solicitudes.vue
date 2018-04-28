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
          titulo: 'Lista de solicitudes de tutor realizadas por estudiantes',
          link: 'ver solicitud',
          url: './responder',
          mensaje: 'No tiene solicitudes',
      	  columns: ['nombre','mensaje','estatus','respuesta','fecha_solicitud'],
      	  titulos: ['Estudiante','Mensaje','Estatus','Respuesta','Fecha de solicitud','Ver solicitud'],
          sortKey: ''
        }
      },
      components:{
		tableOrder
      },
      beforeMount () {
      	this.$http.get('/api/solicitudes').then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {
              if(!value.estatus){
                value.estatus=''
              }
              if(!value.mensaje){
                value.mensaje=''
              }
              if(!value.respuesta){
                value.respuesta=''
              }
  		    	  let tema = {
                fecha_solicitud : value.fecha_solicitud,
                estatus : value.estatus.toLowerCase(),
                mensaje : value.mensaje.toLowerCase(),
  			    	  respuesta : value.respuesta.toLowerCase(),
  			    	  id: value.id,
  			    	  nombre: value.estudiante_nombre.toLowerCase() + ' ' + value.estudiante_apellido
  		    	  }
  		    	  datos.push(tema)
		        },this)
            this.data = datos
            this.id_tutor = response.body.tutor_id
            this.total = Math.ceil(response.body.total/response.body.per_page)
  		    }
  		  }, response => {
  		    // error callback
  		    console.log(response)
  		  });
      },
      methods: {
        functionName: function(pageNum) {
          this.$http.get('/api/solicitudes?page='+pageNum).then(response => {
            // get body data
            let datos = []
            if (response) {
              response.body.data.forEach(function (value, i) {
                if(!value.estatus){
                  value.estatus=''
                }
                if(!value.mensaje){
                  value.mensaje=''
                }
                if(!value.respuesta){
                  value.respuesta=''
                }
                let tema = {
                  fecha_solicitud : value.fecha_solicitud,
                  estatus : value.estatus.toLowerCase(),
                  mensaje : value.mensaje.toLowerCase(),
                  respuesta : value.respuesta.toLowerCase(),
                  id: value.id,
                  nombre: value.estudiante_nombre.toLowerCase() + ' ' + value.estudiante_apellido
                }
                datos.push(tema)
              },this)
              this.data = datos
              this.id_tutor = response.body.tutor_id
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