document.addEventListener('DOMContentLoaded', () => {
  const overlay = document.getElementById('contactModal');
  if (!overlay) return;

  // 安全に要素取得して反映するためのヘルパー
  const setText = (id, value) => {
    const el = document.getElementById(id);
    if (!el) return; // 無い項目があっても落ちない
    el.innerText = value ?? '-';
  };

  const setValue = (id, value) => {
    const el = document.getElementById(id);
    if (!el) return;
    el.value = value ?? '';
  };

  // 開く
  document.querySelectorAll('.btn-detail').forEach((btn) => {
    btn.addEventListener('click', () => {
      // data-* から取得
      const name = btn.dataset.name || '-';
      const gender = btn.dataset.gender || '-';
      const email = btn.dataset.email || '-';
      const category = btn.dataset.category || '-';
      const tel = btn.dataset.tel || '-';
      const address = btn.dataset.address || '-';
      const building = btn.dataset.building || '-';
      const detail = btn.dataset.detail || '-';
      const id = btn.dataset.id || '';

      // モーダルへ反映
      setText('m_name', name);
      setText('m_gender', gender);
      setText('m_email', email);
      setText('m_category', category);
      setText('m_tel', tel);
      setText('m_address', address);
      setText('m_building', building);
      setText('m_detail', detail);
      setValue('m_id', id);

      // 開く
      overlay.classList.add('is-open');
      overlay.setAttribute('aria-hidden', 'false');
    });
  });

  // 閉じる（×ボタン）
  overlay.querySelectorAll('[data-modal-close]').forEach((btn) => {
    btn.addEventListener('click', closeModal);
  });

  // 背景クリックで閉じる
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeModal();
  });

  // ESCで閉じる
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });

  function closeModal() {
    overlay.classList.remove('is-open');
    overlay.setAttribute('aria-hidden', 'true');
  }
});
