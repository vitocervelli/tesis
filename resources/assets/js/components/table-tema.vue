<template>
	<div>
		
	  <table-order 
	  	:data="data"
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
          data: Array,
          total: 1,
          titulo: 'Temas de tesis recibidos',
          link: 'responder',
          url: 'responder',
          mensaje: 'No ha recibido temas',
    	  columns: ['fecha_envio','linea_investigacion','titulo','descripcion','estatus','respuesta','nombre_tutor'],
    	  titulos: ['Fecha','Linea de investigación','Titulo','Descripción','Estatus','Respuesta','Tutor','Responder'],
          sortKey: ''
        }
      },
      components:{
		tableOrder
      },
      beforeMount () {
      	this.$http.get('/api/tema').then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {

		    	  if(!value.respuesta){
		    	  	value.respuesta=''
		    	  }
		    	  if(!value.estatus){
		    	  	value.estatus=''
		    	  }
		    	  let tema = {
			    	  fecha_envio : value.fecha_envio,
			    	  linea_investigacion : value.linea_investigacion.toLowerCase(),
			    	  titulo: value.titulo.toLowerCase(),
			    	  id: value.id,
			    	  nombre_tutor: value.nombre_tutor + ' ' + value.apellido_tutor ,
			    	  estatus: value.estatus.toLowerCase(),
			    	  respuesta: value.respuesta.toLowerCase(),
			    	  descripcion: value.descripcion.toLowerCase()
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
          this.$http.get('/api/tema?page='+pageNum).then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {

		    	  if(!value.respuesta){
		    	  	value.respuesta=''
		    	  }
		    	  if(!value.estatus){
		    	  	value.estatus=''
		    	  }
		    	  let tema = {
			    	  fecha_envio : value.fecha_envio,
			    	  linea_investigacion : value.linea_investigacion.toLowerCase(),
			    	  titulo: value.titulo.toLowerCase(),
			    	  id: value.id,
			    	  nombre_tutor: value.nombre_tutor + ' ' + value.apellido_tutor ,
			    	  estatus: value.estatus.toLowerCase(),
			    	  respuesta: value.respuesta.toLowerCase(),
			    	  descripcion: value.descripcion.toLowerCase()
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
        }
      }
    }
</script>