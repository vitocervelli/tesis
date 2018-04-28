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
          titulo: 'Lista de estudiantes que usted tiene asignado',
          link: 'seleccione',
          url: './estudiante_ver',
          mensaje: 'Hasta el momento no tienes ningún Estudiante asignado',
          columns: ['nombre','estatus'],
          titulos: ['Estudiante','Estatus'],
          sortKey: ''
        }
      },
      components:{
    tableOrder
      },
      beforeMount () {
        this.$http.get('/api/proyectos').then(response => {
          // get body data
          let datos = []
          if (response) {
            response.body.data.forEach(function (value, i) {
              let tema = {
                id: value.id,
                estatus: value.estatus,
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
      },
      methods: {
        functionName: function(pageNum) {
          this.$http.get('/api/proyectos?page='+pageNum).then(response => {
            // get body data
            let datos = []
            if (response) {
              response.body.data.forEach(function (value, i) {
                let tema = {
                  id: value.id,
                  estatus: value.estatus,
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
        }
      }
    }
</script>