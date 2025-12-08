document.addEventListener('DOMContentLoaded', () => {
    const year = document.querySelector('select[name="birth-year"]');
    const month = document.querySelector('select[name="birth-month"]');
    const date = document.querySelector('select[name="birth-date"]');
    const hidden = document.querySelector('input[name="fulldate"]');
    const customErrorContainer = document.querySelector('.wpcf7-custom-item-error.fulldate');

    function updateFullDate() {
        const y = year ? year.value : '';
        const m = month ? month.value : '';
        const d = date ? date.value : '';

        if (y && m && d) {
            if (hidden) hidden.value = `${y}-${m.padStart(2, '0')}-${d.padStart(2, '0')}`;
            // エラーをクリア
            if (customErrorContainer) customErrorContainer.innerHTML = '';
        } else {
            if (hidden) hidden.value = '';
        }
    }

    if (year) year.addEventListener('change', updateFullDate);
    if (month) month.addEventListener('change', updateFullDate);
    if (date) date.addEventListener('change', updateFullDate);

    // CF7バリデーションエラー時にエラーメッセージを移動
    const wpcf7Form = document.querySelector('.wpcf7');
    if (wpcf7Form) {
        wpcf7Form.addEventListener('wpcf7invalid', function() {
            setTimeout(function() {
                // birth-yearのエラーメッセージを取得
                const birthYearWrap = document.querySelector('[data-name="birth-year"]');
                if (birthYearWrap && customErrorContainer) {
                    const errorTip = birthYearWrap.querySelector('.wpcf7-not-valid-tip');
                    if (errorTip) {
                        // エラーメッセージをカスタム位置にコピー
                        customErrorContainer.innerHTML = '<span class="wpcf7-not-valid-tip">' + errorTip.textContent + '</span>';
                        // 元のエラーを非表示
                        errorTip.style.display = 'none';
                    }
                }
            }, 100);
        });

        // 送信成功時にエラーをクリア
        wpcf7Form.addEventListener('wpcf7mailsent', function() {
            if (customErrorContainer) customErrorContainer.innerHTML = '';
        });
    }

    const submitButton = document.querySelector('.submit');
    const privacy = document.querySelector('input[name="privacy[]"]');
    
    if (privacy && submitButton) {
        privacy.addEventListener('change', function() {
            if (privacy.checked) {
                submitButton.classList.add('is-active');
            } else {
                submitButton.classList.remove('is-active');
            }
        });
    }

});

