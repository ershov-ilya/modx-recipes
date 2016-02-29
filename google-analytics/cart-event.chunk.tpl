<script type="text/javascript">
  $(function () {

    $(".add-to-cart").on("click", function () {
      var $$ = $(this);
      dataLayer.push({
        'event': 'addToCart',
        'ecommerce': {
          'currencyCode': 'RUB',
          'add': {
            'products': [{
              'name':  $$.attr('name'),
              'id': $$.attr('id'),
              'price': $$.attr('price'),
              'brand': $$.attr('brand'),
              'category': $$.attr('category'),
              'variant': $$.attr('variant'),
              'quantity': 1
            }]
          }
        }
      });
    });

    var product = {
      'name': '[[+ga_name]]',
      'id': '[[+ga_id]]',
      'price': '[[+ga_price]]',
      'brand': '[[+ga_brand]]',
      'category': '[[+ga_category]]',
      'variant': '[[+ga_material]]',
      'article': '[[+ga_article]]'
    };

    dataLayer.push({
      'ecommerce': {
        'detail': {
          'actionField': {'list': '[[+ga_category]]'},
          'products': [product]
        }
      }
    });
  });
</script>
