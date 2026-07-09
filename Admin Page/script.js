/*APPROVE / REJECT*/
function setStatus(id, status) {
  if (!confirm('Are you sure you want to ' + (status === 'approved' ? 'approve' : 'reject') + ' this entry?')) {
    return;
  }

  fetch('update_status.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({ id: id, status: status })
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert(status === 'approved' ? 'Entry approved and published!' : 'Entry rejected.');
      window.location.reload();
    } else {
      alert('Error: ' + data.error);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An error occurred.');
  });
}