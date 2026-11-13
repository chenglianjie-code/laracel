<form action="{{ route('create/weibo') }}" method="POST">
  @include('shared._errors')
  @csrf
  <label class="status-form-label" for="status-content">微博内容</label>
  <textarea id="status-content" class="status-textarea" rows="4" maxlength="255" placeholder="聊聊新鲜事儿..." name="content">{{ old('content') }}</textarea>
  <div class="status-form-actions">
    <span class="status-form-hint">最多 255 个字符</span>
    <button class="status-submit" type="submit">
      <span>发布</span>
      <span class="status-submit-arrow" aria-hidden="true">→</span>
    </button>
  </div>
</form>
