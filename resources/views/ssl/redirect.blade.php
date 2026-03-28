<form id="sslPay" method="POST" action="{{ $direct_api_url }}">
  @foreach($post_data as $key => $value)
    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
  @endforeach
</form>

<script>
  document.getElementById('sslPay').submit();
</script>
