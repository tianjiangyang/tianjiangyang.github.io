(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-885ea4e8"],{"0929":function(t,o,e){"use strict";e.r(o);var s=function(){var t=this,o=t.$createElement,e=t._self._c||o;return e("div",{staticClass:"list-box"},[e("van-tabs",{attrs:{animated:"",swipeable:"",sticky:""}},t._l(t.typeList,function(o,s){return e("van-tab",{key:s,staticClass:"goodtb",attrs:{title:o.text}},[e("List",{attrs:{goodlist:t.goodList,goods:t.goodList.filter(function(t){return t.type.value==o.value}),id:""},on:{changeallgoods:t.getNewGoodList}})],1)}),1)],1)},n=[],i=function(){var t=this,o=t.$createElement,e=t._self._c||o;return e("div",[e("van-pull-refresh",{on:{refresh:t.onRefresh},model:{value:t.isLoading,callback:function(o){t.isLoading=o},expression:"isLoading"}},t._l(t.goods,function(t,o){return e("Item",{key:o,attrs:{good:t,id:""}})}),1)],1)},a=[],r=function(){var t=this,o=t.$createElement,e=t._self._c||o;return e("div",{staticClass:"clearfix item-box"},[e("router-link",{attrs:{to:{name:"goodDetail",params:{goodId:t.good._id},query:{name:t.good.name}}}},[e("img",{staticClass:"goodImg",attrs:{src:t.good.img,alt:""}}),e("div",{staticClass:"item-r"},[e("h4",{staticClass:"goodDec"},[t._v(t._s(t.good.name))]),e("p",{staticClass:"goodPrice"},[t._v("￥"+t._s(t.good.price)+" ")])])])],1)},c=[],d={props:["good"]},l=d,u=(e("9ece"),e("2877")),g=Object(u["a"])(l,r,c,!1,null,"31d56734",null),f=g.exports,m={data:function(){return{isLoading:!1}},components:{Item:f},props:["goodlist","goods"],methods:{onRefresh:function(){var t=this;console.log("开始 刷新..."+this.isLoading),setTimeout(function(){t.isLoading=!1,t.$toast("下拉刷新成功"),t.$emit("changeallgoods")},1e3)}},mounted:function(){}},p=m,v=Object(u["a"])(p,i,a,!1,null,null,null),h=v.exports,L={data:function(){return{typeList:[],goodList:[]}},components:{List:h},methods:{getNewGoodList:function(){this.goodList.reverse()}},mounted:function(){var t=this;this.$axios.get("/vue/getGoodTypes").then(function(o){t.typeList=o.data.result}),this.$axios.get("/vue/getGoods").then(function(o){t.goodList=o.data.result})}},b=L,_=(e("b8e5"),Object(u["a"])(b,s,n,!1,null,"713c1f82",null));o["default"]=_.exports},"9ece":function(t,o,e){"use strict";var s=e("b234"),n=e.n(s);n.a},b234:function(t,o,e){},b8e5:function(t,o,e){"use strict";var s=e("f23f"),n=e.n(s);n.a},f23f:function(t,o,e){}}]);
//# sourceMappingURL=chunk-885ea4e8.9b1ef339.js.map