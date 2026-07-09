/* ---------- Sign Up Modal ---------- */
function scrollToSubmit() {
  document.getElementById('submit').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function openSignUp() {
  document.getElementById('signUpModal').classList.add('open');
  document.getElementById('signUpSuccess').classList.remove('show');
  ['su-username','su-password','su-password2'].forEach(id => {
    document.getElementById(id).value = '';
  });
}

function closeSignUpBtn() {
  document.getElementById('signUpModal').classList.remove('open');
}

function closeSignUp(e) {
  if (e.target === document.getElementById('signUpModal')) {
    closeSignUpBtn();
  }
}

function submitSignUp() {
  const username  = document.getElementById('su-username').value.trim();
  const password  = document.getElementById('su-password').value;
  const password2 = document.getElementById('su-password2').value;

  if (!username || !password || !password2) {
    alert('Please fill in all fields.');
    return;
  }
  if (password !== password2) {
    alert('Passwords do not match. Please try again.');
    return;
  }
  if (password.length < 6) {
    alert('Password must be at least 6 characters.');
    return;
  }

  document.getElementById('signUpSuccess').classList.add('show');
  ['su-username','su-password','su-password2'].forEach(id => {
    document.getElementById(id).value = '';
  });
}

/* ---------- Submit Form ---------- */
function updateCharCount(el) {
  const count = el.value.length;
  const el2 = document.getElementById('charCount');
  if (el2) {
    el2.textContent = count + ' character' + (count !== 1 ? 's' : '');
    el2.style.color = count > 300 ? '#c0392b' : 'var(--warm-gray)';
  }
}

function submitForm() {
  const name     = document.getElementById('f-name').value.trim();
  const year     = document.getElementById('f-year').value.trim();
  const company  = document.getElementById('f-company').value.trim();
  const role     = document.getElementById('f-role').value.trim();
  const industry = document.getElementById('f-industry').value;
  const advice   = document.getElementById('f-advice').value.trim();

  if (!name || !year || !company || !role || !industry || !advice) {
    alert('Please fill in all required fields.');
    return;
  }

  document.getElementById('successMsg').classList.add('show');
  document.getElementById('successMsg').scrollIntoView({ behavior: 'smooth', block: 'center' });

  ['f-name','f-company','f-role','f-advice','f-year','f-id'].forEach(id => {
    document.getElementById(id).value = '';
  });
  document.getElementById('f-industry').value = '';
}