<div class="modal-overlay" id="contactModal" aria-hidden="true">
    <div class="modal-card modal-card--detail" role="dialog" aria-modal="true">

        <button
            type="button"
            class="modal-close-circle"
            data-modal-close
            aria-label="閉じる">
            ×
        </button>

        <div class="modal-body--detail">
            <table class="modal-table--detail">
                <tr>
                    <th>お名前</th>
                    <td id="m_name">-</td>
                </tr>
                <tr>
                    <th>性別</th>
                    <td id="m_gender">-</td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td id="m_email">-</td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td id="m_tel">-</td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td id="m_address">-</td>
                </tr>
                <tr>
                    <th>建物名</th>
                    <td id="m_building">-</td>
                </tr>
                <tr>
                    <th>お問い合わせの種類</th>
                    <td id="m_category">-</td>
                </tr>
                <tr class="modal-message-row">
                    <th>お問い合わせ内容</th>
                    <td id="m_detail">-</td>
                </tr>
            </table>

            <form
                action="/delete"
                method="post"
                class="modal-delete-form"
                onsubmit="return confirm('削除しますか？');">
                @csrf
                <input type="hidden" name="id" id="m_id" value="">
                <button type="submit" class="btn-delete-modal">
                    削除
                </button>
            </form>
        </div>
    </div>
</div>