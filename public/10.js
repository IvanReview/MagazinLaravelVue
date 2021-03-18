(window.webpackJsonp=window.webpackJsonp||[]).push([[10],{204:function(t,s,e){"use strict";var a=e(48);e.n(a).a},205:function(t,s,e){(t.exports=e(5)(!1)).push([t.i,".images-product[data-v-7487b1f0]{border:2px solid #d6a279}.child[data-v-7487b1f0]{margin-left:100px}.disabled[data-v-7487b1f0]{pointer-events:none;opacity:.4}.review-text[data-v-7487b1f0]{width:100%}.review-item[data-v-7487b1f0]{border:1px solid hsla(0,0%,75.3%,.4);padding:10px;margin-bottom:10px}#test2[data-v-7487b1f0]{padding-bottom:40px}.images img[data-v-7487b1f0]{width:70px}",""])},266:function(t,s,e){"use strict";e.r(s);var a=e(1),i=e(4),r=e(9);function n(t,s){var e=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);s&&(a=a.filter((function(s){return Object.getOwnPropertyDescriptor(t,s).enumerable}))),e.push.apply(e,a)}return e}function o(t){for(var s=1;s<arguments.length;s++){var e=null!=arguments[s]?arguments[s]:{};s%2?n(Object(e),!0).forEach((function(s){c(t,s,e[s])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(e)):n(Object(e)).forEach((function(s){Object.defineProperty(t,s,Object.getOwnPropertyDescriptor(e,s))}))}return t}function c(t,s,e){return s in t?Object.defineProperty(t,s,{value:e,enumerable:!0,configurable:!0,writable:!0}):t[s]=e,t}var l={name:"OneProduct",props:{},data:function(){return{prodId:"",product:[],comments:{},loader:!0,users:[],comment:{name:"",text:"",parent_id:"0",product_id:"",user_id:""},replyingTo:{},btnOldHtml:"",errorsComment:[]}},beforeRouteEnter:function(t,s,e){e((function(s){s.prodId=t.params.id}))},computed:o({},Object(a.c)(["getProductsInCart","getErrorsWriteComment"])),methods:o(o({},Object(a.b)(["incrementCart","decrementCart","deleteProductCart","totalSumInCart","addProductsToCart"])),{},{authorOfComment:function(t){return this.users.find((function(s){return s.id==t.user_id}))},comment_status_filter:function(t){return t.filter((function(t){return 0!==Number(t.status)}))},setReplyingTo:function(t){var s=this;this.comment.parent_id=t.id,this.replyingTo=t,this.$refs.form.scrollIntoView({behavior:"smooth",block:"center"}),setTimeout((function(){s.$refs.inputName.focus()}),200)},productQuantity:function(){var t=this,s=this.getProductsInCart.find((function(s){return s.id==t.prodId}));return s?s.quantity:0},fetchData:function(){var t=this;axios.get("/api/product/".concat(this.prodId)).then((function(s){t.product=s.data.product,t.comments=s.data.comments,t.users=s.data.users,t.comment.product_id=s.data.product.id}))},addToCart:function(){var t=this;this.addProductsToCart(this.product).then((function(s){s?t.$toasted.show("Товар ".concat(t.product.name," закончился"),{type:"error",position:"bottom-left"}):t.$toasted.show("Товар ".concat(t.product.name," добавлен успешно!"),{type:"success",position:"bottom-left"})}))},decrementItem:function(t){var s=this,e=this.getProductsInCart.findIndex((function(t){return t.id==s.prodId}));this.decrementCart(e)},incrementItem:function(){var t=this,s=this.getProductsInCart.findIndex((function(s){return s.id==t.prodId})),e=this.getProductsInCart.find((function(s){return s.id==t.prodId}));e.quantity+1<=e.count?this.incrementCart(s):this.$toasted.show("Увы товар ".concat(e.name," закончился на складе!"),{type:"error"})},commentAdd:function(){var t=this;r.a(this.$refs.btnSubmit),axios({method:"POST",url:"/api/product/".concat(this.prodId,"/comment"),data:this.comment}).then((function(s){if(r.b(t.$refs.btnSubmit),t.replyingTo.id){var e=t.comments.findIndex((function(t){return t.id===s.data.parent_id}));t.comments[e].replies.push(s.data)}else t.comments.push(s.data);t.comment={},t.comment.parent_id="0",t.errorsComment=[],t.$toasted.show("Комментарий успешно добавлен",{position:"bottom-left"})})).catch((function(s){r.b(t.$refs.btnSubmit),t.errorsComment=s.response.data.errors,console.log(s)}))}}),created:function(){this.prodId=window.location.href.split("/")[4],this.fetchData(),setTimeout((function(){M.AutoInit()}),200)},mounted:function(){null!==i.c()&&(this.comment.user_id=i.c().id,this.comment.name=i.c().name)}},d=(e(204),e(0)),u=Object(d.a)(l,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("section",{staticClass:"one-product"},[e("div",{staticClass:"container"},[e("div",{staticClass:"row"},[e("div",{staticClass:"col s12 l6"},[e("div",{staticClass:"images-product"},[e("img",{staticClass:"materialboxed1",attrs:{width:"500",src:"/storage/"+t.product.image,alt:"prod"}})])]),t._v(" "),e("div",{staticClass:"col s12 l6"},[e("div",{staticClass:"summary"},[e("h2",{staticClass:"product-name"},[e("a",{attrs:{href:"#"}},[t._v(t._s(t.product.name))])]),t._v(" "),e("div",{staticClass:"price"},[e("div",[e("span",{staticClass:"amount"},[t._v("$ "+t._s(t._f("currencyFilter")(t.product.price)))])]),t._v(" "),e("div",[e("span",{staticClass:"discount"},[t._v("$ "+t._s(1.2*t.product.price))])])]),t._v(" "),e("div",{staticClass:"des"},[e("p",[t._v(t._s(t.product.description))])]),t._v(" "),t._m(0),t._v(" "),e("div",{staticClass:"quantity"},[e("label",[t._v("Количество: ")]),t._v(" "),e("div",{staticClass:"minus qt",class:{disabled:!t.productQuantity()},on:{click:function(s){return t.decrementItem(t.product)}}},[e("i",{staticClass:"fa fa-minus"})]),t._v(" "),e("div",{staticClass:"count"},[e("span",[t._v(t._s(t.productQuantity()))])]),t._v(" "),e("div",{staticClass:"qt plus",class:{disabled:!t.productQuantity()},on:{click:function(s){return t.incrementItem()}}},[e("i",{staticClass:"fa fa-plus",attrs:{disabled:"disabled"}})])]),t._v(" "),t._m(1),t._v(" "),t.product.count?e("div",{staticClass:"buttons clearfix"},[e("a",{staticClass:"button cart-button btn",attrs:{href:" "},on:{click:function(s){return s.preventDefault(),t.addToCart(s)}}},[e("i",{staticClass:"material-icons right"},[t._v("add")]),t._v(" Добавить\n                        ")])]):e("div",{staticClass:"buttons clearfix"},[t._m(2)])])])]),t._v(" "),e("div",{staticClass:"tabs-container"},[e("div",{staticClass:"row"},[t._m(3),t._v(" "),t._m(4),t._v(" "),e("div",{staticClass:"col s12",attrs:{id:"test2"}},[e("div",{staticClass:"tab-content tab-rev clearfix",attrs:{id:"tab-reviews"}},[e("div",{staticClass:"col s12 l7"},[t.comments.length?e("div",{staticClass:"review-content"},[e("ul",{staticClass:"review"},t._l(t.comments,(function(s){return e("div",{staticClass:"comment-wrapper"},[e("li",{staticClass:"review-item"},[e("div",{staticClass:"images"},[e("img",{attrs:{src:s.user_id?"/storage/"+t.authorOfComment(s).image:"/img/avata-01.jpg",alt:""}})]),t._v(" "),e("div",{staticClass:"review-text"},[e("div",{},[e("h3",{staticClass:"name"},[e("span",[t._v(t._s(s.name))])]),t._v(" "),e("div",{staticClass:"des-rev"},[t._v(t._s(s.text))])]),t._v(" "),e("div",{staticClass:"button-wrapper"},[e("div",{staticClass:"time"},[t._v(t._s(t._f("dateFilter")(s.created_at)))])]),t._v(" "),e("button",{staticClass:"btn-small",on:{click:function(e){return t.setReplyingTo(s)}}},[e("i",{staticClass:"material-icons left"},[t._v("reply")]),t._v("\n                                                    ответить\n                                                ")])])]),t._v(" "),t._l(t.comment_status_filter(s.replies),(function(a){return e("li",{staticClass:"review-item child"},[e("div",{staticClass:"images"},[e("img",{attrs:{src:a.user_id?"/storage/"+t.authorOfComment(a).image:"/img/avata-02.jpg",alt:""}})]),t._v(" "),e("div",{staticClass:"review-text"},[e("div",{},[e("h3",{staticClass:"name"},[e("span",[t._v(t._s(a.name))])]),t._v(" "),e("div",{staticClass:"des-rev"},[t._v(t._s(a.text))])]),t._v(" "),e("div",{staticClass:"button-wrapper"},[e("div",{staticClass:"time"},[t._v(t._s(t._f("dateFilter")(a.created_at)))])]),t._v(" "),e("button",{staticClass:"btn-small",on:{click:function(e){return t.setReplyingTo(s)}}},[e("i",{staticClass:"material-icons left"},[t._v("reply")]),t._v("\n                                                    ответить\n                                                ")])])])}))],2)})),0)]):e("div",{staticClass:"no-review"},[e("p",[t._v("Отзывов пока нет, будьте первым!")])])]),t._v(" "),e("div",{staticClass:"col s12 l5"},[e("div",{staticClass:"form-review"},[t._m(5),t._v(" "),e("form",{ref:"form",staticClass:"comment-form",on:{submit:function(s){return s.preventDefault(),t.commentAdd(s)}}},[e("input",{directives:[{name:"model",rawName:"v-model",value:t.comment.name,expression:"comment.name"}],ref:"inputName",attrs:{type:"text",size:"30",placeholder:"Ваше имя*"},domProps:{value:t.comment.name},on:{input:function(s){s.target.composing||t.$set(t.comment,"name",s.target.value)}}}),t._v(" "),t.errorsComment.name?e("span",{staticClass:"helper-text invalid"},[t._v("\n                                        "+t._s(t.errorsComment.name[0])+"\n                                    ")]):t._e(),t._v(" "),e("textarea",{directives:[{name:"model",rawName:"v-model",value:t.comment.text,expression:"comment.text"}],staticClass:"materialize-textarea",attrs:{placeholder:"Сообщение *"},domProps:{value:t.comment.text},on:{input:function(s){s.target.composing||t.$set(t.comment,"text",s.target.value)}}}),t._v(" "),t.errorsComment.text?e("span",{staticClass:"helper-text invalid"},[t._v("\n                                        "+t._s(t.errorsComment.text[0])+"\n                                    ")]):t._e(),t._v(" "),e("div",{staticClass:"subreview"},[e("button",{ref:"btnSubmit",staticClass:"btn",attrs:{type:"submit"}},[e("i",{staticClass:"material-icons left"},[t._v("comment")]),t._v(" "),e("span",[t._v("Добавить отзыв")])])])])])])])]),t._v(" "),t._m(6)])])])])}),[function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"product-options"},[e("div",{staticClass:"sizes-product"},[e("strong",[t._v("Размеры:")]),t._v(" "),e("a",{attrs:{href:"#"}},[e("span",[t._v("XS ")])]),t._v(" "),e("a",{attrs:{href:"#"}},[e("span",[t._v("S ")])]),t._v(" "),e("a",{attrs:{href:"#"}},[e("span",[t._v("M ")])]),t._v(" "),e("a",{attrs:{href:"#"}},[e("span",[t._v("L ")])]),t._v(" "),e("a",{attrs:{href:"#"}},[e("span",[t._v("XL ")])])]),t._v(" "),e("div",{staticClass:"scolor-product"},[e("strong",[t._v("Цвета: ")]),t._v(" "),e("div",{staticClass:"colors"},[e("div",{staticClass:"c-blue color blue"},[e("span")]),t._v(" "),e("div",{staticClass:"c-gray color red"},[e("span")]),t._v(" "),e("div",{staticClass:"c-purple color purple teal"},[e("span")]),t._v(" "),e("div",{staticClass:"c-yellow color black"},[e("span")]),t._v(" "),e("div",{staticClass:"c-red color purple"},[e("span")])])])])},function(){var t=this.$createElement,s=this._self._c||t;return s("div",{staticClass:"social social-product clearfix"},[s("div",{staticClass:"label-social"},[this._v("поделиться: ")]),this._v(" "),s("ul",[s("li",[s("a",{attrs:{href:"#",target:"_blank"}},[s("i",{staticClass:"fab fa-twitter"})])]),this._v(" "),s("li",[s("a",{attrs:{href:"#",target:"_blank"}},[s("i",{staticClass:"fab fa-pinterest"})])]),this._v(" "),s("li",[s("a",{attrs:{href:"#",target:"_blank"}},[s("i",{staticClass:"fab fa-facebook-square"})])]),this._v(" "),s("li",[s("a",{attrs:{href:"#",target:"_blank"}},[s("i",{staticClass:"fab fa-behance"})])]),this._v(" "),s("li",[s("a",{attrs:{href:"#",target:"_blank"}},[s("i",{staticClass:"fab fa-dribbble"})])])])])},function(){var t=this.$createElement,s=this._self._c||t;return s("button",{staticClass:"button cart-button btn red"},[s("i",{staticClass:"material-icons right"},[this._v("cancel")]),this._v(" Товара нет в наличии\n                        ")])},function(){var t=this.$createElement,s=this._self._c||t;return s("div",{staticClass:"col s12"},[s("ul",{staticClass:"tabs"},[s("li",{staticClass:"tab col s3"},[s("a",{attrs:{href:"#test1"}},[this._v("Описание")])]),this._v(" "),s("li",{staticClass:"tab col s3"},[s("a",{staticClass:"active",attrs:{href:"#test2"}},[this._v("Отзывы")])]),this._v(" "),s("li",{staticClass:"tab col s3 last"},[s("a",{attrs:{href:"#test3"}},[this._v("Теги")])])])])},function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"col s12",attrs:{id:"test1"}},[e("div",{staticClass:"tab-content tab-des clearfix",staticStyle:{display:"block"},attrs:{id:"tab-description"}},[e("h3",[t._v("In a free hour, when our power of choice")]),t._v(" "),e("p",[t._v("This is a custom CMS block. You can use it to display information about shipping, returns, refunds, latest promotions etc. Put any content you want here, like text, HTML, images or videos. There are many useful blocks like this one across the theme. All CMS blocks are editable from the admin panel. You can delete block static Custom Tab if you want.")]),t._v(" "),e("p",[e("span",[t._v("Shipping:")]),t._v(" Please allow about 5-10 business days for delivery. For delivery to Alaska or Hawaii, please allow 10-15 days for delivery. For delivery to PO Boxes in Alaska, Hawaii, US Territories and APO/FPO addresses, allow three weeks for delivery.")]),t._v(" "),e("p",[e("span",[t._v("Backorders:")]),t._v(" All backordered items will be shipped via Standard Delivery service at no additional charge.")]),t._v(" "),e("p",[e("span",[t._v("Returns Policy:")]),t._v(" You may return new, unworn or unused products within thirty (30) days of delivery for a full refund of the cost of the goods, or an exchange if")])])])},function(){var t=this.$createElement,s=this._self._c||t;return s("h3",{staticClass:"form-rev"},[s("span",[this._v("Оставьте свой отзыв")])])},function(){var t=this.$createElement,s=this._self._c||t;return s("div",{staticClass:"col s12",attrs:{id:"test3"}},[s("div",{staticClass:"tab-content add-tags clearfix",attrs:{id:"tab-add_tags"}},[s("h3",{staticClass:"addtag"},[s("span",[this._v("Add Your Tags")])]),this._v(" "),s("form",{attrs:{method:"post",action:"#"}},[s("input",{attrs:{type:"text",value:"",placeholder:"Your tags here"}}),this._v(" "),s("div",{staticClass:"add-tags"},[s("a",{attrs:{href:"#"}},[s("span",[this._v("Add Tags")])])]),this._v(" "),s("p",[this._v("Use spaces to separate tags. Use single quotes (') for phrases.")])])])])}],!1,null,"7487b1f0",null);s.default=u.exports},48:function(t,s,e){var a=e(205);"string"==typeof a&&(a=[[t.i,a,""]]);var i={hmr:!0,transform:void 0,insertInto:void 0};e(6)(a,i);a.locals&&(t.exports=a.locals)},9:function(t,s,e){"use strict";function a(t){t.setAttribute("disabled","disabled"),this.btnOldHtml=t.innerHTML,t.innerHTML='<span class = "fa fa-spinner fa-spin"></span> Пожалуйста подождите...'}function i(t){t.removeAttribute("disabled"),t.innerHTML=this.btnOldHtml}e.d(s,"a",(function(){return a})),e.d(s,"b",(function(){return i}))}}]);