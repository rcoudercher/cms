<script type="text/javascript">            
  fetch('/api/pageViews', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      page: window.location.href,
      referrer: document.referrer,
    }),
  })
  .then(response => response.json())
  .then(data => {
    // console.log('Success:', data);
  })
  .catch((error) => {
    // console.error('Error:', error);
  });
</script>
