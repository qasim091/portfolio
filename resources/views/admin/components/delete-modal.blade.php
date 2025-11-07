<!-- Modern Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
    <div class="bg-card rounded-2xl shadow-2xl border border-border/50 max-w-md w-full transform transition-all scale-95 opacity-0" id="deleteModalContent">
        <!-- Modal Header -->
        <div class="p-6 border-b border-border/50">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center">
                    <i data-lucide="alert-triangle" class="w-6 h-6 text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-foreground">{{ $title ?? 'Delete Item' }}</h3>
                    <p class="text-sm text-muted-foreground">This action cannot be undone</p>
                </div>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <p class="text-foreground mb-2">{{ $message ?? 'Are you sure you want to delete this item?' }}</p>
            <div class="bg-muted/30 rounded-lg p-3 border border-border/50">
                <p class="text-sm font-medium text-foreground" id="deleteItemName"></p>
                <p class="text-xs text-muted-foreground mt-1">{{ $warning ?? 'All data associated with this item will be permanently removed.' }}</p>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="p-6 border-t border-border/50 flex items-center justify-end gap-3">
            <button type="button" 
                    onclick="closeDeleteModal()"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-muted hover:bg-muted/80 text-foreground rounded-lg transition-all">
                <i data-lucide="x" class="w-4 h-4"></i>
                <span class="font-medium">Cancel</span>
            </button>
            <button type="button" 
                    onclick="confirmDelete()"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all shadow-lg shadow-red-500/20">
                <i data-lucide="trash-2" class="w-4 h-4"></i>
                <span class="font-medium">{{ $buttonText ?? 'Delete Item' }}</span>
            </button>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
    let deleteForm = null;

    function showDeleteModal(form, itemName) {
        deleteForm = form;
        document.getElementById('deleteItemName').textContent = itemName;
        
        const modal = document.getElementById('deleteModal');
        const content = document.getElementById('deleteModalContent');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Animate in
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);

        // Re-initialize Lucide icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        const content = document.getElementById('deleteModalContent');
        
        // Animate out
        content.classList.remove('scale-100', 'opacity-100');
        content.classList.add('scale-95', 'opacity-0');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            deleteForm = null;
        }, 200);
    }

    function confirmDelete() {
        if (deleteForm) {
            deleteForm.submit();
        }
    }

    // Close modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // Close modal on backdrop click
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush
@endonce
