

<template>
   <div>
       <div class="o-card p-4 ">
       <form id="posForm" class="row">
           <div class="form-group col-4">
           <label for="Barcode">Barcode</label>
           <input name="barcode" @keyup="checkbarcode" type="text" class="form-control">
       </div>
       <div class="form-group col-4">
           <label for="Product">Product</label>
           <select class="form-control" name="" id="prd">
               <option selected disabled></option>
                   <option  v-for="(item, index) in products" :key="item.id"  :value="index">
                       {{selected = index}}
                    {{ item.name }}
                </option>
               </select>
       </div>
       <div class="form-group col-3">
           <label for="Quantity">Quantity</label>
           <input name="qty" id="qty" type="text" class="form-control">
       </div>
       <div class="form-group col-1">
           <label for="Quantity"></label>
           <input id="che" type="submit" value="ADD" class="form-control">
       </div>
       </form>
   </div>

   <div>
       <ul>
           <li v-for="(item, index) in billables" :key="item.id"  :value="index">
               sdsd
           </li>
       </ul>
   </div>
   </div>
</template>

<script>

import axios from 'axios';
import "vue-auto-complete-input";
export default {
    data: function(){
        return {
            name:"Oswin",
            products:[],
            billables:[],
            selected:null
        }
    },
    props:['items'],
    methods:{
        checkbarcode(e){
            this.products.forEach(function(prod,i){
                console.log(prod)
                if(prod.barcode==e.target.value){
                    // alert(0)
                    $('#prd').val(i);
                    $('#qty').focus();
                }
            })
        },
        check(){
            alert(0)
        }
    },mounted(){
        axios.get('/api/products').then(da=>{
            console.log(da.data.data)
           console.log(this.products = da.data.data)
        })
        $('#che').on( 'keyup', function( e ) {
            console.log(e.which)

        if( e.which == 9 ) {
            console.log( $('#posForm').serialize() );
            this.billables.push({
                prod:this.products[selected]
            
            })
            selected= null;

        }
    });
    }
}

$(document).ready( function () {
    name = "s"
    $('#table_id').DataTable({searching: false, paging: false, info: false});

    $(document).ready(function() {
    $('.js-example-basic-single').select2();

    
});
} );
</script>