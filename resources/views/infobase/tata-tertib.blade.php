@extends('layouts.app')

@section('content')
<style>
    /* Simple Header Style */
    .simple-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem 0;
    }

    .simple-header .header-left h1 {
        color: #000000;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: none;
    }

    .simple-header .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .tata-tertib-container {
        display: grid;
        grid-template-columns: 250px 1fr;
        gap: 2rem;
        max-width: 1400px;
        margin: 0 auto;
        padding: 3rem 2rem;
        width: 100%;
        box-sizing: border-box;
    }

    /* Sidebar */
    .tata-tertib-sidebar {
        position: sticky;
        top: 100px;
        height: fit-content;
    }

    .sidebar-title {
        font-size: 1rem;
        font-weight: 700;
        color: #111;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-bottom: 2px solid #063A76;
        padding-bottom: 0.5rem;
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .category-item {
        margin-bottom: 0.5rem;
    }

    .category-link {
        display: block;
        padding: 0.75rem 1rem;
        color: #374151;
        text-decoration: none;
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
        border-radius: 0 4px 4px 0;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .category-link:hover {
        background-color: #f3f4f6;
        border-left-color: #063A76;
        color: #063A76;
    }

    .category-link.active {
        background-color: #EEF2F7;
        border-left-color: #063A76;
        color: #063A76;
        font-weight: 700;
    }

    /* Content Area */
    .tata-tertib-content {
        padding: 0;
    }

    /* Category Section */
    .category-section {
        margin-bottom: 3rem;
        scroll-margin-top: 120px;
    }

    .category-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .category-header::before {
        content: '';
        width: 4px;
        height: 32px;
        background: #063A76;
        border-radius: 2px;
    }

    .category-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #111;
        margin: 0;
    }

    .category-count {
        display: inline-block;
        background: #f3f4f6;
        color: #6b7280;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-left: auto;
    }

    /* Rules Container */
    .rules-container {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .rule-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: visible;
        word-wrap: break-word;
        overflow-wrap: break-word;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
    }

    .rule-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: #063A76;
        border-radius: 0;
    }

    .rule-card:hover {
        border-color: #063A76;
        box-shadow: 0 4px 12px rgba(6, 58, 118, 0.15);
        transform: translateY(-2px);
    }

    .rule-number {
        display: inline-flex;
        background: #EEF2F7;
        color: #063A76;
        width: 32px;
        height: 32px;
        min-width: 32px;
        min-height: 32px;
        border-radius: 50%;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
        flex-shrink: 0;
    }

    .rule-text {
        color: #374151;
        line-height: 1.7;
        font-size: 1rem;
        margin: 0;
        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: normal;
        flex: 1;
    }

    .rule-text img {
        max-width: 100%;
        width: 100%;
        max-height: 350px;
        height: auto;
        display: block;
        object-fit: contain;
        border-radius: 6px;
        margin: 1rem 0 0 0;
        border: 1px solid #e5e7eb;
    }

    .rule-text ul,
    .rule-text ol {
        margin-left: 1.5rem;
        margin-top: 0.75rem;
    }

    .rule-text li {
        margin-bottom: 0.5rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: #f3f4f6;
        border-radius: 8px;
        border: 2px dashed #e5e7eb;
    }

    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: #1f2937;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 0.95rem;
        margin-top: 0.5rem;
    }

    /* Search Bar */
    .search-container {
        margin-bottom: 2rem;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #063A76;
        box-shadow: 0 0 0 3px rgba(6, 58, 118, 0.1);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .tata-tertib-container {
            grid-template-columns: 1fr;
            padding: 1.5rem;
        }

        .tata-tertib-sidebar {
            position: static;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.5rem;
            margin-bottom: 2rem;
        }

        .category-link {
            padding: 0.5rem;
            text-align: center;
            border-left: none;
            border-bottom: 3px solid transparent;
        }

        .category-link:hover,
        .category-link.active {
            border-left: none;
            border-bottom-color: #063A76;
            background-color: #EEF2F7;
        }

        .category-header h2 {
            font-size: 1.5rem;
        }

        .category-count {
            margin-left: 0.5rem;
        }

        .rule-card {
            flex-direction: column;
            align-items: flex-start;
        }

        .rule-number {
            align-self: flex-start;
        }
    }
</style>

<div class="page-header simple-header">
    <div class="header-content">
        <div class="header-left">
            <h1>TATA TERTIB DAN PERATURAN</h1>
        </div>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

<!-- Main Content -->
<div class="tata-tertib-container">
    <!-- Sidebar -->
    <aside class="tata-tertib-sidebar">
        <div class="sidebar-title">Kategori</div>
        <ul class="category-list">
            @forelse($jenis as $j)
            <li class="category-item">
                <a href="#category-{{ $j->id }}" class="category-link" onclick="setActiveCategory(this)">
                    {{ $j->name }}
                </a>
            </li>
            @empty
            <li class="category-item">
                <p style="color: #9ca3af; font-size: 0.9rem;">Tidak ada kategori</p>
            </li>
            @endforelse
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="tata-tertib-content">
        @forelse($jenis as $j)
        <section class="category-section" id="category-{{ $j->id }}">
            <div class="category-header">
                <h2>{{ $j->name }}</h2>
                <span class="category-count">{{ count($j->tataTertibs) }} aturan</span>
            </div>

            @if(count($j->tataTertibs) > 0)
            <div class="rules-container">
                @forelse($j->tataTertibs as $index => $t)
                <div class="rule-card">
                    <div class="rule-number">{{ $index + 1 }}</div>
                    <p class="rule-text">{!! $t->content !!}</p>
                </div>
                @empty
                <div class="empty-state">
                    <i class="fas fa-inbox"></i>
                    <h3>Belum ada aturan</h3>
                    <p>Kategori ini belum memiliki butir aturan.</p>
                </div>
                @endforelse
            </div>
            @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Belum ada aturan</h3>
                <p>Kategori ini belum memiliki butir aturan.</p>
            </div>
            @endif
        </section>
        @empty
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h3>Data Tidak Ditemukan</h3>
            <p>Belum ada kategori tata tertib yang tersedia.</p>
        </div>
        @endforelse
    </main>
</div>

<script>
    function setActiveCategory(element) {
        // Remove active class from all links
        document.querySelectorAll('.category-link').forEach(link => {
            link.classList.remove('active');
        });
        // Add active class to clicked link
        element.classList.add('active');
    }

    // Set Active based on scroll position
    window.addEventListener('scroll', () => {
        const sections = document.querySelectorAll('.category-section');
        let current = '';

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 200) {
                current = section.getAttribute('id');
            }
        });

        document.querySelectorAll('.category-link').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + current) {
                link.classList.add('active');
            }
        });
    });
</script>
@endsection