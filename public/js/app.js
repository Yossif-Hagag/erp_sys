var addMessage = `<div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show" role="alert">
<svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
    <use xlink:href="#check-circle-fill" />
</svg>
<div>تمت الاضافة</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;

var edtMessage = `<div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show" role="alert">
<svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
    <use xlink:href="#check-circle-fill" />
</svg>
<div>تم التعديــل</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;

var doneMessage = `<div class="alert alert-dismissible alert-success align-items-center h3em d-flex fade justify-content-between m-2 show" role="alert">
<svg class="bi flex-shrink-0 me-2 w-7 h-7" role="img" aria-label="Success:">
    <use xlink:href="#check-circle-fill" />
</svg>
<div>تمــت العمـليـه</div>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
//------------------------------------------------------------------------
$(document).on('submit', '#product-form', function (e) {
  e.preventDefault();
  var keyword = $('#search-product').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/product/search',
    method: 'GET',
    data: {
      keyword: keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('.paginate').remove();
      $('#total-number-product').html('عدد المنتجات:  : ' + response.total_number_of_products); // Update the total number of products
      $('#total-product-price').html('الشراء : ' + response.total_product_price  ); // Update the total number of products
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#purchas-form', function (e) {
  e.preventDefault();
  var purchas_search = $('#purchas_search').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/purchas/search',
    method: 'GET',
    data: {
      purchas_search: purchas_search,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('.paginate').remove();
      $('#total-price').html('التوريدات : ' + response.total_price  ); // Update the total number of products
      $('#total-number-product').html(' عدد المنتجات  : ' + response.total_number_product);
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#rent-form', function (e) {
  e.preventDefault();
  var rent_keyword = $('#rent_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/rent/search',
    method: 'GET',
    data: { 
      rent_keyword: rent_keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('.paginate').remove();
      $('.paginate').remove();
      $('#sum-rent-price').html('  الإيجار: ' + response.sum_rent_price  ); // Update the total number of products
      $('#total-supply-rent').html(' الشراء: ' + response.total_supply_rent);
      $('#total-number-rent').html(' عدد المنتجات  : ' + response.total_number_rent);
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#catalogue-form', function (e) {
  e.preventDefault();
  var catalogue_keyword = $('#catalogue_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/catalogue/search',
    method: 'GET',
    data: { 
      catalogue_keyword: catalogue_keyword,
      from_date: from_date,
      to_date: to_date,
     },
    success: function (response) {
      $('#data-body').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#scrap-form', function (e) {
  e.preventDefault();
  var scrap_keyword = $('#scrap_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/scrap/search',
    method: 'GET',
    data: { 
      scrap_keyword: scrap_keyword, 
      from_date: from_date, 
      to_date: to_date, 
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('.paginate').remove();
      $('#total-window-body').html('الشراء : ' + response.total_scrap_price  ); // Update the total number of products
      $('#total-number-scrap').html('عدد المنتجات:  : ' + response.total_number_scrap); // Update the total number of products
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#user-form', function (e) {
  e.preventDefault();
  var user_keyword = $('#user_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/user/search',
    method: 'GET',
    data: { 
      user_keyword: user_keyword, 
      from_date: from_date, 
      to_date: to_date, 
    },
    success: function (response) {
      $('#data-body').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#po-form', function (e) {
  e.preventDefault();
  var po_keyword = $('#po_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/po/search',
    method: 'GET',
    data: { 
      po_keyword: po_keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#po-collection-form', function (e) {
  e.preventDefault();
  var po_collection_keyword = $('#po_collection_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/po_collection/search',
    method: 'GET',
    data: { 
      po_collection_keyword: po_collection_keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#expenses-form', function (e) {
  e.preventDefault();
  var expenses_keyword = $('#expenses_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/expenses/search',
    method: 'GET',
    data: { 
      expenses_keyword: expenses_keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#agents-form', function (e) {
  e.preventDefault();
  var search_agents = $('#search_agents').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/agents/search',
    method: 'GET',
    data: { 
      search_agents: search_agents,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#fixedsup-form', function (e) {
  e.preventDefault();
  var search_fixedsup = $('#search_fixedsup').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/fixedsup/search',
    method: 'GET',
    data: { 
      search_fixedsup: search_fixedsup,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body-fixed').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#eachsup-form', function (e) {
  e.preventDefault();
  var search_eachsup = $('#search_eachsup').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/eachsup/search',
    method: 'GET',
    data: { 
      search_eachsup: search_eachsup,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body-each').html(response);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#operation_stock-form', function (e) {
  e.preventDefault();
  var operation_stock_keyword = $('#operation_stock_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/operation_stock/search',
    method: 'GET',
    data: { 
      operation_stock_keyword: operation_stock_keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('.paginate').remove();
      $('#total-sell-price').html('البيع : ' + response.totalSellPrice  ); // Update the total number of products
      $('#total-buy-price').html(' الشراء  : ' + response.totalbuyPrice);
      var profit = response.totalSellPrice - response.totalbuyPrice;
      var loss = response.totalbuyPrice - response.totalSellPrice;

      if (response.totalSellPrice > response.totalbuyPrice) {
        $('#profit').html('<p class="bg-success text-white w-50 mx-auto p-2">الربح: ' + profit + '</p>');
    } else if (response.totalSellPrice < response.totalbuyPrice) {
        $('#profit').html('<p class="bg-danger text-white w-50 mx-auto p-2">الخسارة: ' + loss + '</p>');
    } else {
        $('#profit').html('<p>لا يوجد ربح أو خسارة</p>');
    }
    } ,
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#operation_purchas-form', function (e) {
  e.preventDefault();
  var operation_purchas_keyword = $('#operation_purchas_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/operation_purchas/search',
    method: 'GET',
    data: { 
      operation_purchas_keyword: operation_purchas_keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('.paginate').remove();
      $('#total-sell-price').html('التكلفة : ' + response.totalSellPrice  ); // Update the total number of products
    

  
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#operation_scrap-form', function (e) {
  e.preventDefault();
  var operation_scrap_keyword = $('#operation_scrap_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/operation_scrap/search',
    method: 'GET',
    data: { 
      operation_scrap_keyword: operation_scrap_keyword,
      from_date: from_date,
      to_date: to_date,
      
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('.paginate').remove();
      $('#total-sell-price').html('البيع : ' + response.totalSellPrice  ); // Update the total number of products
      $('#total-buy-price').html(' الشراء  : ' + response.totalbuyPrice);
      var profit = response.totalSellPrice - response.totalbuyPrice;
      var loss = response.totalbuyPrice - response.totalSellPrice;

      if (response.totalSellPrice > response.totalbuyPrice) {
        $('#profit').html('<p class="bg-success text-white w-50 mx-auto p-2">الربح: ' + profit + '</p>');
    } else if (response.totalSellPrice < response.totalbuyPrice) {
        $('#profit').html('<p class="bg-danger text-white w-50 mx-auto p-2">الخسارة: ' + loss + '</p>');
    } else {
        $('#profit').html('<p>لا يوجد ربح أو خسارة</p>');
    }
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});
$(document).on('submit', '#quotation-form', function (e) {
  e.preventDefault();
  var quotation_keyword = $('#quotation_keyword').val();
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();

  $.ajax({
    url: '/quotations/search',
    method: 'GET',
    data: { 
      quotation_keyword: quotation_keyword,
      from_date: from_date,
      to_date: to_date,
    },
    success: function (response) {
      $('#data-body').html(response.data_view);
      $('#total-price').html('السعر : ' + response.total_price);
      $('.paginate').remove();
    },
    error: function (xhr, status, error) {
      console.log(xhr.responseText);
    }
  });
});