<template>
  <table class="table table-hover">
    <thead v-if="titulo">
      <tr>
        <th :colspan="titulos.length">{{titulo}}</th>
      </tr>
    </thead>
    <tbody v-if="data.length > 0">
      <tr>
        <th v-for="(key,index) in columns"
          @click="sortBy(key)"
          :class="{ active: sortKey == key }">
          {{ titulos[index] }}
          <span class="arrow" :class="sortOrders[key] > 0 ? 'asc' : 'dsc'">
          </span>
        </th>
        <th v-if="link2">{{link2 | capitalize }}</th>
        <th v-if="linkPdf">{{linkPdf | capitalize }}</th>
        <th>{{link | capitalize }}</th>
      </tr>
      <tr v-for="(entry,index) in filteredData">
        <td v-for="key in columns">
          {{entry[key] | capitalize}}
        </td>
        <td v-if="link2">
          <a :href="url2+'/'+entry.id"> {{link2 | capitalize }}</a>
        </td>
        <td v-if="linkPdf">
          <a :href="urlPdf+entry.idPdf"> {{linkPdf | capitalize }}</a>
        </td>
        <td>
          <a :href="url+'/'+entry.id"> {{link | capitalize }}</a>
        </td>
      </tr>
    </tbody>

    <tbody v-else>
      <tr>
        <td colspan="6"><h4 class="error">{{mensaje}}</h4></td>
      </tr>
    </tbody>
  </table>
  
</template>

<script>
    export default {
      props: {
        data: {},
        columns: Array,
        titulos: Array,
        titulo: String,
        mensaje: String,
        link: String,
        url: String,
        link2: String,
        url2: String,
        linkPdf: String,
        urlPdf: String,
        filterKey: String
      },
      data: function () {
        var sortOrders = {}
        this.columns.forEach(function (key) {
          sortOrders[key] = 1
        })
        return {
          sortKey: '',
          sortOrders: sortOrders
        }
      },
      computed: {
        filteredData: function () {
          var sortKey = this.sortKey
          var filterKey = this.filterKey && this.filterKey.toLowerCase()
          var order = this.sortOrders[sortKey] || 1
          var data = this.data
          if (filterKey) {
            data = data.filter(function (row) {
              return Object.keys(row).some(function (key) {
                return String(row[key]).toLowerCase().indexOf(filterKey) > -1
              })
            })
          }
          if (sortKey) {
            data = data.slice().sort(function (a, b) {
              a = a[sortKey]
              b = b[sortKey]
              return (a === b ? 0 : a > b ? 1 : -1) * order
            })
          }
          return data
        }
      },
      filters: {
        capitalize: function (str) {
          return str.charAt(0).toUpperCase() + str.slice(1)
        }
      },
      methods: {
        sortBy: function (key) {
          this.sortKey = key
          this.sortOrders[key] = this.sortOrders[key] * -1
        }
      }
    }
</script>