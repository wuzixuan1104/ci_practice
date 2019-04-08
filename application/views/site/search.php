<div id="app">
  <div id="searchBox">
    <!-- <search-box :result.sync="data"></search-box> -->
    <search-box @submit="init" :post="post"></search-box>
  </div>
  <hr>
  <div id="searchContent">
    <div class="search-filter">
      <div>篩選項目</div>
      <div>星級</div>
      <div class="stars">
        <input id="star_chk5" type="checkbox" value="5" v-model="star">5星
        <input id="star_chk4" type="checkbox" value="4" v-model="star">4星
        <input id="star_chk3" type="checkbox" value="3" v-model="star">3星
        <input id="star_chk2" type="checkbox" value="2" v-model="star">2星
        <input id="star_chk1" type="checkbox" value="1" v-model="star">1星
      </div>
    </div>
    <hr>
    <div>成人xxxx：{{post.adult}}</div>
    <hr>
    <div class="search-result">
      <div class="top">
        <div>查詢到<span>{{this.filterResult.length}}</span>個結果</div>
        <div class="tag">
          <span v-for="s in star"><label :for="setStarID(s)">{{s}}星</label> / </span>
        </div>
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

    </div>[1,2,3]
    <hr>
    <div>
      <button type="button" @click="clickCnt(0)">-</button>
      <button type="button" @click="clickCnt(1)">+</button>
      <select v-for="i in cnt" @change="updSelected" :data-i="i">
        <option value="1" selected>1</option>
        <option value="2" :data-i="i" >2</option>
        <option value="3" :data-i="i" >3</option>
      </select>
    </div>
  </div>

  <paginate
    :page-count="pageCnt"
    :click-handler="clickPaginate"
    :prev-text="'<'"
    :next-text="'>'"
    :container-class="'className'">
  </paginate>

</div>

<script>

  Vue.component('search-box', {
    props: ['data', 'post'],
    data() {
      return {
        keyword_list : null,
        date_start: '2019-04-07',
        date_end: '2019-05-07',
        place: '',
        adult: 1,
        child: 0,
        result: this.data,
        url: '',
        postRes: this.post,
      };
    },
    
    mounted() {
      this.url = new URL(window.location.href);
      this.getUrlQuery();
    },

    methods: {
      submit() {
        if (this.place === '') {
          alert('請填寫區域');
          return false;
        }

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
            that.setUrlQuery();
            // that.$emit('update:result', resp);
            that.$emit('submit', that.result, that.url);
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
      },

      setUrlQuery() {
        this.date_start && (this.url.searchParams.set('date_start', this.date_start));
        this.date_end && (this.url.searchParams.set('date_end', this.date_end));
        this.place && (this.url.searchParams.set('place', this.place));
        this.adult && (this.url.searchParams.set('adult', this.adult));
        this.url.searchParams.set('child', this.child);

        window.history.pushState('', '', this.url.href);
      },

      getUrlQuery() {
        let params = new URLSearchParams(this.url.search.slice(1));

        params.has('date_start') && (this.date_start = params.get('date_start'));
        params.has('date_end') && (this.date_end = params.get('date_end'));
        params.has('adult') && (this.adult = params.get('adult'));
        params.has('child') && (this.child = params.get('child'));
        params.has('place') && (this.place = params.get('place'));

        if (this.place) this.submit();
      },
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
              <button type="button" @click="adult > 1 && adult--">-</button> <span>{{adult}}</span>位成人 <button type="button" @click="adult < 5 && adult++">+</button>
            </div>
            <div>
              <button type="button" @click="child > 0 && child--">-</button> <span>{{child}}</span>位兒童 <button type="button" @click="child < 5 && child++">+</button>
            </div>
          </div>
        </div>
        成人xxx<input type="text" v-model="postRes.adult">
        <button type="submit">Submit</button>
      </form>
    `,
  });
  
  Vue.component('paginate', VuejsPaginate);

  new Vue({
    el: '#app',
    data: {
      rowPage: 5,
      data: [], //更新的資料
      filterResult: [], //過濾過的資料
      result: [], //全部資料
      star: [],
      url: '',
      post: {'adult': 1, 'child': 0},
      selected: [],
      cnt: 0,
      key: 1,
    },

    computed: {
      pageCnt() {
        return Math.ceil(this.filterResult.length / this.rowPage);
      },
    },

    methods: {
      init(val, url) {
        this.data = val;
        this.result = this.data; 
        this.FilterResult = this.data; 
        this.url = url;

        let params = new URLSearchParams(this.url.search.slice(1));
        params.has('star') && params.get('star') && (this.star = params.get('star').split(','));
      },

      filterData() {
        if (!this.data)
          return false;

        const that = this;

        this.data = this.result;

        if (this.star && this.star[0]) {
          this.data = this.result.slice().filter(function(v) {
            return that.star.indexOf(v.star.toString()) != -1;
          });
          this.url.searchParams.set('star', this.star.join(','));
        } 

        this.filterResult = this.data;
        this.updPaginate(1);

        window.history.pushState('', '', this.url.href);
      },

      //修改分頁數
      updPaginate(val) {
        let startIdx = this.rowPage * (val - 1);
        let endIdx = this.rowPage * (val - 1) + this.rowPage;

        this.data = this.filterResult.slice(startIdx, endIdx);
      },

      //點擊分頁
      clickPaginate(val) {
        this.updPaginate(val);
      },

      setStarID(val) {
        return 'star_chk' + val;
      },

      clickCnt(val) {
        if (val) {
          this.selected.push(1);
          this.cnt++;
        } else {
          this.selected.pop();
          this.cnt--;
        }
        console.log(this.cnt);
        console.log(this.selected);
      },

      updSelected(e) {
        // if(e.target.value) {
        //     console.log(e.target.value)
        //     console.log(e.target.dataset.i);
        // }

        // console.log('updSelected');
        idx = parseInt(e.target.dataset.i) - 1;
        this.selected.splice(idx, 1, parseInt(e.target.value));

        console.log('-----');
        console.log(this.selected);
      }
    },

    watch: {
      star() {
        this.filterData();
        console.log(this.post.adult);
      },
      post() {
        console.log(this.post);
      },
      selected() {
        console.log(this.selected);
      }
    }
  });

</script>

