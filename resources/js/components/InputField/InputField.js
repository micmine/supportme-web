const axios = require('axios');

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
};

export default {
    data: function () {
        return {
          templates: []
        }
    },
    methods: {
      load() {
        axios.get('/template')
            .then(function (response) {
              this.templates = response;
              console.log(response);
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            })
      }
    },
    beforeMount() {
      // load
    }
};