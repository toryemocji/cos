<section class="chat-container">
  <div id="chat-box" style="height: 300px; overflow-y: scroll; border: 1px solid #ccc; padding: 1em;"></div>
  <?php if ($loggedIn): ?>
  <form id="chat-form">
    <input type="text" id="message" placeholder="Napisz wiadomość..." required />
    <button type="submit">Wyślij</button>
  </form>
  <?php else: ?>
    <p>Musisz być zalogowany, aby pisać wiadomości.</p>
  <?php endif; ?>
</section>

<script>
function loadMessages() {
  fetch('../backend/get_messages.php')
    .then(res => res.json())
    .then(data => {
      const box = document.getElementById('chat-box');
      box.innerHTML = '';
      data.reverse().forEach(msg => {
        const line = document.createElement('div');
        line.textContent = `[${msg.created_at}] ${msg.username}: ${msg.message}`;
        box.appendChild(line);
      });
    });
}

document.getElementById('chat-form')?.addEventListener('submit', e => {
  e.preventDefault();
  const formData = new FormData();
  formData.append('message', document.getElementById('message').value);

  fetch('../backend/send_message.php', {
    method: 'POST',
    body: formData
  }).then(() => {
    document.getElementById('message').value = '';
    loadMessages();
  });
});

setInterval(loadMessages, 2000);
loadMessages();
</script>
