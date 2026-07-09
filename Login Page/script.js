/* ---------- Sign Up Modal (used by Header.php) ---------- */
function scrollToSubmit() {
  document.getElementById('submit').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function openSignUp() {
  document.getElementById('signUpModal').classList.add('open');
}

function closeSignUpBtn() {
  document.getElementById('signUpModal').classList.remove('open');
}

function closeSignUp(e) {
  if (e.target === document.getElementById('signUpModal')) {
    closeSignUpBtn();
  }
}

/* ---------- Profile Form: character counter ---------- */
function updateCharCount(el) {
  const count = el.value.length;
  const el2 = document.getElementById('charCount');
  if (el2) {
    el2.textContent = count + ' character' + (count !== 1 ? 's' : '');
    el2.style.color = count > 300 ? '#c0392b' : 'var(--warm-gray)';
  }
}

/* ---------- Basic client-side check before native submit ----------
   The real validation & DB work happens in submit.php / login.php */
document.addEventListener('DOMContentLoaded', () => {
  const profileForm = document.getElementById('profileForm');
  if (profileForm) {
    profileForm.addEventListener('submit', (e) => {
      const image = document.getElementById('f-image').files[0];
      const pdf   = document.getElementById('f-pdf').files[0];
      if (!image) {
        alert('Please upload a profile image.');
        e.preventDefault();
        return;
      }
      if (!pdf) {
        alert('Please upload a PDF file.');
        e.preventDefault();
        return;
      }
    });
  }
});