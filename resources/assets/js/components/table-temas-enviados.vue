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
          titulo: 'Temas que se le ha enviado al estudiante',
          link: 'ver solicitud',
          url: '../../ver_detalle',
          mensaje: 'No se le ha enviado ningun tema hasta ahora',
      	  columns: ['fecha_envio','linea_investigacion','titulo','descripcion','estatus','respuesta'],
      	  titulos: ['Fecha de envio','Linea de investigacion','Titulo', 'Descripcion','Estatus','Respuesta','Ver detalles'],
          sortKey: ''
        }
      },
      components:{
    		tableOrder
      },
      beforeMount () {
        let v = window.location.pathname
        v=v.replace('/tema/enviar','/api/temas_enviados')
      	this.$http.get(v).then(response => {
  		    // get body data
  		    let datos = []
  		    if (response) {
  		    	response.body.data.forEach(function (value, i) {
            if(!value.respuesta){
              value.respuesta = ' '
            }
            if(!value.estatus){
              value.estatus = ' '
            }
		    	  let tema = {
			    	  linea_investigacion : value.linea_investigacion.toLowerCase(),
              fecha_envio: value.fecha_envio,
              respuesta: value.respuesta,
              estatus: value.estatus,
              descripcion: value.descripcion,
              titulo: value.titulo,
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
          let v = window.location.pathname
          v=v.replace('tema/enviar','api/temas_enviados')
          this.$http.get(v+'?page='+pageNum).then(response => {
            // get body data
            let datos = []
            if (response.body.data) {
              response.body.data.forEach(function (value, i) {
              if(!value.respuesta){
                value.respuesta = ''
              }
              if(!value.estatus){
                value.estatus = ' '
              }
              let tema = {
                linea_investigacion : value.linea_investigacion.toLowerCase(),
                fecha_envio: value.fecha_envio,
                respuesta: value.respuesta,
                estatus: value.estatus,
                descripcion: value.descripcion,
                titulo: value.titulo,
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