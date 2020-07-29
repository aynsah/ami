var total_assets = 0 
var amount_of_zakat = 0, total_zakat = 0
var price_of_goods = new Object()
var nishab = new Object()

$(window).on('load', function () {
  refreshform(0)
  set_default_nishab()
 });

function set_value(){
  price_of_goods['harga-beras'] = 14000
  price_of_goods['harga-emas'] = 560835
  price_of_goods['harga-perak'] = 460835

  for (const [name, value] of Object.entries(price_of_goods)) {
    $("input[name='"+name+"']").val(value)
  }
}

function set_default_nishab(){
  nishab['zakat-fitrah'] = 0
  nishab['zakat-tabungan'] = 0
  nishab['zakat-hadiah'] = 0
  nishab['zakat-perdagangan'] = 0
  // 85 * Harga Emas
  nishab['zakat-emas'] = 
  nishab['zakat-simpanan'] =  85 * price_of_goods['harga-emas']

  // 524 * Harga Beras
  nishab['zakat-profesi'] = 
  nishab['zakat-pertanian'] = 524 * price_of_goods['harga-beras']
}

function refreshform(zakat_number){
  set_value()
  switch (zakat_number){
    case 0 : fitrah_calculation()
             break
    case 1 : gold_calculation()
             break
    case 2 : fitrah_calculation()
             break
    case 3 : fitrah_calculation()
             break
    case 4 : fitrah_calculation()
             break
    case 5 : fitrah_calculation()
             break
    case 6 : fitrah_calculation()
             break
    case 7 : agricultural_calculation()
             break
    default : fitrah_calculation()
  }
}

function zakat_show(){
  if(check_condition(total_assets)){
    $("input[name='kadar-zakat']").val(amount_of_zakat)
    table_calc($("input[name='qty-zakat']"))
  }else{
      $("input[name='kadar-zakat-kg']").val(0)
      $("input[name='kadar-zakat']").val(0)
      $('.tb-list-1').html('Rp.0')
      $('.tb-list-2').html(0)
      $('.tb-total').html('Rp.0')
  }
}

function table_calc(field_qty){
    if ($(field_qty).val() < 0) {
      $(field_qty).val(0)
      table_calc(field_qty)
    }
    else if(!$(field_qty).val()){
      $('.tb-list-1').html('Rp. ' + currencyFormat(amount_of_zakat))
      $('.tb-list-2').html('1')
      $('.tb-total').html('Rp. ' + currencyFormat(amount_of_zakat))
    }else{
      total_zakat = ($(field_qty).val()) * amount_of_zakat
      $('.tb-list-1').html('Rp. ' + currencyFormat(amount_of_zakat))
      $('.tb-list-2').html($(field_qty).val())
      $('.tb-total').html('Rp. ' + currencyFormat(total_zakat))

      $('#zakatAmount').val(total_zakat)
    }
}

function check_condition(amount){
  zakat_type = $('#zakatType').val()
  $("input[name='nishab-zakat']").val(nishab[zakat_type])
  if(amount > nishab[zakat_type] || zakat_type == 'zakat-fitrah'){
    $('#zakatCondition').addClass('text-success')
    $('#zakatCondition').removeClass('text-danger')
    $('#zakatCondition').text('Ya')
    $('#bayarZakat').attr('disabled','false')

    return true
  }else{
    $('#zakatCondition').addClass('text-danger')
    $('#zakatCondition').removeClass('text-success')
    $('#zakatCondition').text('Tidak')
    $('#bayarZakat').attr('disabled','true')

    return false
  }
}
  
function fitrah_calculation(){
  total_assets = $("input[name='harga-beras']").val()
  amount_of_zakat = (total_assets * 2.5).toFixed(0)
  zakat_show()
}

function gold_calculation(){
  var amount_of_gold = 1, gold_price = 1
  amount_of_gold = positive_variable($("input[name='jumlah-emas']").val())
  gold_price = positive_variable($("input[name='harga-emas']").val())

  nishab['zakat-emas'] = 85 * gold_price
  total_assets = amount_of_gold * gold_price
  amount_of_zakat = (total_assets * 0.025).toFixed(0)
  zakat_show()
}

function profession_calculation(){
  var income = 1, outcome = 0, rice_price = 1
  income = positive_variable($("input[name='jumlah-penghasilan']").val())
  outcome = positive_variable($("input[name='jumlah-pengeluaran']").val())

  rice_price = positive_variable($("input[name='harga-beras']").val())


  nishab['zakat-profesi'] = 524 * rice_price
  total_assets = income - outcome
  amount_of_zakat = (total_assets * 0.025).toFixed(0)
  zakat_show()
}

function agricultural_calculation(){
  var amount_of_harvest = 1, gold_price = 1
  var amount_of_zakat_kg = 1

  amount_of_harvest = positive_variable($("input[name='jumlah-panen']").val())
  harvest_price = positive_variable($("input[name='harga-panen']").val())

  total_assets = amount_of_harvest * harvest_price
  if ($("input[name='irigasi']").prop('checked')) {
    amount_of_zakat = (total_assets * 0.05).toFixed(0)
    amount_of_zakat_kg = (amount_of_harvest * 0.05).toFixed(0)

  }else{
    amount_of_zakat = (total_assets * 0.1).toFixed(0)
    amount_of_zakat_kg = (amount_of_harvest * 0.1).toFixed(0)
  }

  $("input[name='kadar-zakat-kg']").val(amount_of_zakat_kg)
  zakat_show()
}

$("form").submit(function() {
  $("input[name='harga-beras']").attr('name','')
});