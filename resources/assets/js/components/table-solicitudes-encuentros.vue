<template>
  <div>  
    <table-order :data="data"
      :columns="columns"
      :titulos="titulos"
      :titulo="titulo"
      :link="link"
      :url="url"
      :link2="link2"
      :url2="url2"
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
          titulo: 'Encuentros Solicitados por tus estudiantes',
          link: 'responder',
          url: './responder',
          link2: 'ver',
          url2: './ver',
          mensaje: 'No hay encuentros',
      	  columns: ['estudiante_nombre','fecha_solicitud','metodo','fecha_encuentros','solicitud','duracion','respuesta'],
      	  titulos: ['Estudiante','Fecha de solicitud','Tipo','Fecha de encuentro','Descripción','Duración','Respuesta'],
          sortKey: ''
        }
      },
      components:{
    		tableOrder
      },
      beforeMount () {
      	this.$http.get('/api/solicitudes_encuentros').then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {
              if(!value.fecha_encuentros){
               value.fecha_encuentros = ''
              }
              if(!value.metodo){
               value.metodo = ''
              }
              if(!value.solicitud){
                value.solicitud = ''
              }
              if(!value.duracion){
                value.duracion = ''
              }
              if(!value.respuesta){
                value.respuesta = ''
              }
  		    	  let tema = {
                fecha_solicitud : value.fecha_solicitud.toLowerCase(),
  			    	  fecha_encuentros : value.fecha_encuentros.toLowerCase(),
                metodo: value.metodo,
                solicitud: value.solicitud,
                duracion: value.duracion,
                respuesta: value.respuesta,
                estudiante_nombre: value.estudiante_nombre.toLowerCase() + ' ' + value.estudiante_apellido,
  			    	  id: value.id
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
          this.$http.get('/api/solicitudes_encuentros?page='+pageNum).then(response => {
          // get body data
          let datos = []
          if (response) {
            response.body.data.forEach(function (value, i) {

              if(!value.fecha_encuentros){
               value.fecha_encuentros = ''
              }
              if(!value.metodo){
               value.metodo = ''
              }
              if(!value.solicitud){
                value.solicitud = ''
              }
              if(!value.duracion){
                value.duracion = ''
              }
              if(!value.respuesta){
                value.respuesta = ''
              }
              let tema = {
                fecha_solicitud : value.fecha_solicitud.toLowerCase(),
                fecha_encuentros : value.fecha_encuentros.toLowerCase(),
                metodo: value.metodo,
                solicitud: value.solicitud,
                duracion: value.duracion,
                respuesta: value.respuesta,
                estudiante_nombre: value.estudiante_nombre.toLowerCase() + ' ' + value.estudiante_apellido,
                id: value.id
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