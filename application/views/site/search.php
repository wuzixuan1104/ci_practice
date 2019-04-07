<div id="app">
  <div id="searchBox">
    <!-- <search-box :result.sync="data"></search-box> -->
    <search-box @submit="setData"></search-box>
  </div>
  <hr>
  <div id="searchContent">
    <div class="search-filter">
      <div>篩選項目</div>
      <div>星級</div>
      <div class="stars">
        <input type="checkbox" @click="setStar(5)">5星
        <input type="checkbox" @click="setStar(4)">4星
        <input type="checkbox" @click="setStar(3)">3星
        <input type="checkbox" @click="setStar(2)">2星
        <input type="checkbox" @click="setStar(1)">1星
      </div>
    </div>
    <hr>
    <div class="search-result">
      <div class="top">
        <div>查詢到<span>5</span>個結果</div>
        <div class="tag"><span>4星</span>/<span>3星</span></div>
      </div>
      <br/>
      <div class="result" v-if="data" v-for="d in data">
        <div class="box">
          <div>{{d['title']}}</div>
          <div>{{d['star']}} 星</div>
          <div>NT${{d['price']}}</div>
          <hr>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  Vue.component('search-box', {
    props: ['data'],
    data() {
      return {
        keyword_list : null,
        date_start: '2019-04-07',
        date_end: '2019-05-07',
        place: '',
        adult: 1,
        child: 0,
        result: this.data,
      };
    },
    
    methods: {
      submit() {
        const that = this;
        $.getJSON('http://dev.ci.com.tw/search/result', 
          { date_start: this.date_start, 
            date_end: this.date_end, 
            place: this.place, 
            adult: this.adult, 
            child: this.child
          },
          function(resp) {
            that.result = resp;
            // that.$emit('update:result', resp);
            that.$emit('submit', resp);
          });
      },

      keyword() {
        if (this.place === '') {
          alert('請填寫區域');
          return false;
        }

        const that = this;
        $.getJSON('http://dev.ci.com.tw/search/place', {keyword: this.place}, function(resp) {
          that.keyword_list = resp;
        });
      }
    },

    template: `
      <form @submit.prevent="submit">
        <input type="text" v-model="place" @keyup.enter="keyword" placeholder="地方">

        <div v-if="keyword_list">
          <div v-for="key in keyword_list" @click="place = key">{{key}}</div>
        </div>

        <input type="date" v-model="date_start">
        <input type="date" v-model="date_end">
        <div class="person">
          <span>{{adult}}</span>位成人, <span>{{child}}</span>位兒童

          <div class="personCal">
            <div>
              <button @click="adult > 1 && adult--">-</button> <span>{{adult}}</span>位成人 <button @click="adult < 5 && adult++">+</button>
            </div>
            <div>
              <button @click="child > 0 && child--">-</button> <span>{{child}}</span>位兒童 <button @click="child < 5 && child++">+</button>
            </div>
          </div>
        </div>
        <button type="submit">Submit</button>
      </form>
    `,
  });

  new Vue({
    el: '#app',
    data: {
      data: '',
      result: '',
      star: [],
    },
    methods: {
      setData(val) {
        this.data = val;
        this.result = this.data;
      },

      setStar(val) {
        let idx = this.star.indexOf(val);
        idx !== -1 ? this.star.splice(idx, 1) : this.star.push(val);

        this.filterData();
      },

      filterData() {
        if (!this.data)
          return false;

        const that = this;
        this.data = this.result.slice().filter(function(v) {
          return that.star.indexOf(v.star) != -1;
        });
      }
    }
  });

</script>

