(()=>{"use strict";const n=function(n,e){var a,o="function"==typeof n?n.options:n;if(e&&(o.render=e,o.staticRenderFns=[],o._compiled=!0),a)if(o.functional){o._injectStyles=a;var r=o.render;o.render=function(n,e){return a.call(e),r(n,e)}}else{var t=o.beforeCreate;o.beforeCreate=t?[].concat(t,a):[a]}return{exports:n,options:o}}({name:"VendorTaxFields",props:{vendorInfo:{type:Object},errors:{type:Array,required:!1}},created(){this.vendorInfo.company_name_label=dokan.dokan_cf_vendor_labels.company_name,this.vendorInfo.company_id_number_label=dokan.dokan_cf_vendor_labels.company_id_number,this.vendorInfo.vat_number_label=dokan.dokan_cf_vendor_labels.vat_number,this.vendorInfo.bank_name_label=dokan.dokan_cf_vendor_labels.bank_name,this.vendorInfo.bank_iban_label=dokan.dokan_cf_vendor_labels.bank_iban},data:function(){return{vendorEnabledCustomFields:dokan.dokan_cf_vendor_fields}},watch:{"vendorInfo.vat_number":function(n){void 0!==n&&(this.vendorInfo.vat_number=n.trim().replace(/[^A-Za-z0-9]/g,""))},"vendorInfo.company_id_number":function(n){void 0!==n&&(this.vendorInfo.company_id_number=n.trim().replace(/[^A-Za-z0-9]/g,""))}}},(function(){var n=this,e=n._self._c;return e("div",{staticClass:"form-group"},[n.vendorEnabledCustomFields.includes("dokan_company_name")?e("div",{staticClass:"column",staticStyle:{"margin-top":"10px"}},[e("label",{attrs:{for:"company-name"}},[n._v(n._s(n.vendorInfo.company_name_label))]),n._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:n.vendorInfo.company_name,expression:"vendorInfo.company_name"}],staticClass:"dokan-form-input",attrs:{type:"text",id:"company-name",placeholder:n.vendorInfo.company_name_label},domProps:{value:n.vendorInfo.company_name},on:{input:function(e){e.target.composing||n.$set(n.vendorInfo,"company_name",e.target.value)}}})]):n._e(),n._v(" "),n.vendorEnabledCustomFields.includes("dokan_company_id_number")?e("div",{staticClass:"column"},[e("label",{attrs:{for:"company-id-number"}},[n._v(n._s(n.vendorInfo.company_id_number_label))]),n._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:n.vendorInfo.company_id_number,expression:"vendorInfo.company_id_number"}],staticClass:"dokan-form-input",attrs:{type:"text",id:"company-id-number",placeholder:n.vendorInfo.company_id_number_label},domProps:{value:n.vendorInfo.company_id_number},on:{input:function(e){e.target.composing||n.$set(n.vendorInfo,"company_id_number",e.target.value)}}})]):n._e(),n._v(" "),n.vendorEnabledCustomFields.includes("dokan_vat_number")?e("div",{staticClass:"column"},[e("label",{attrs:{for:"vat-tax-number"}},[n._v(n._s(n.vendorInfo.vat_number_label))]),n._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:n.vendorInfo.vat_number,expression:"vendorInfo.vat_number"}],staticClass:"dokan-form-input",attrs:{type:"text",id:"vat-tax-number",placeholder:n.vendorInfo.vat_number_label},domProps:{value:n.vendorInfo.vat_number},on:{input:function(e){e.target.composing||n.$set(n.vendorInfo,"vat_number",e.target.value)}}})]):n._e(),n._v(" "),n.vendorEnabledCustomFields.includes("dokan_bank_name")?e("div",{staticClass:"column"},[e("label",{attrs:{for:"dokan-bank-name"}},[n._v(n._s(n.vendorInfo.bank_name_label))]),n._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:n.vendorInfo.bank_name,expression:"vendorInfo.bank_name"}],staticClass:"dokan-form-input",attrs:{type:"text",id:"dokan-bank-name",placeholder:n.vendorInfo.bank_name_label},domProps:{value:n.vendorInfo.bank_name},on:{input:function(e){e.target.composing||n.$set(n.vendorInfo,"bank_name",e.target.value)}}})]):n._e(),n._v(" "),n.vendorEnabledCustomFields.includes("dokan_bank_iban")?e("div",{staticClass:"column"},[e("label",{attrs:{for:"dokan-bank-iban"}},[n._v(n._s(n.vendorInfo.bank_iban_label))]),n._v(" "),e("input",{directives:[{name:"model",rawName:"v-model",value:n.vendorInfo.bank_iban,expression:"vendorInfo.bank_iban"}],staticClass:"dokan-form-input",attrs:{type:"text",id:"dokan-bank-iban",placeholder:n.vendorInfo.bank_iban_label},domProps:{value:n.vendorInfo.bank_iban},on:{input:function(e){e.target.composing||n.$set(n.vendorInfo,"bank_iban",e.target.value)}}})]):n._e()])})).exports;dokan.addFilterComponent("getVendorAccountFields","dokanVendor",n)})();