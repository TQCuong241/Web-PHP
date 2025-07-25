@vite(['resources/css/index.css', 'resources/js/index.js'])
<x-app-layout>
    <section class="hero-banner">
        <div class="hero-content">
            <h1>Tinh hoa trong từng đường may</h1>
            <p>Khám phá những bộ sưu tập thời trang độc đáo, tôn vinh vẻ đẹp của bạn.</p>
            <div class="hero-buttons">
                <a href="#collections" class="btn-primary">Xem bộ sưu tập</a>
                <a href="/lien-he" class="btn-secondary">Liên hệ tư vấn</a>
            </div>
        </div>
        <div class="hero-image">
            <img src="https://i.pinimg.com/736x/0b/75/87/0b758729c7492f41b14be27ab482dbc0.jpg" alt="Người mẫu trình diễn thời trang">
        </div>
    </section>

    <section class="features-section">
        <div class="section-header">
            <h2>Tại sao chọn chúng tôi?</h2>
            <p>Những giá trị cốt lõi tạo nên thương hiệu của chúng tôi</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-medal"></i>
                </div>
                <h3>Chất liệu cao cấp</h3>
                <p>Chúng tôi tuyển chọn kỹ lưỡng những chất liệu vải tốt nhất, thân thiện với làn da.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-cut"></i> </div>
                <h3>Thiết kế sáng tạo</h3>
                <p>Đội ngũ nhà thiết kế tài năng, luôn cập nhật những xu hướng thời trang mới nhất.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-tshirt"></i> </div>
                <h3>Đường may tỉ mỉ</h3>
                <p>Mỗi sản phẩm đều được hoàn thiện với sự chăm chút, tỉ mỉ trong từng đường kim mũi chỉ.</p>
            </div>
        </div>
    </section>

    <section id="profile" class="profile-section">
        <div class="section-header">
            <h2>Câu chuyện thương hiệu</h2>
            <p>Hành trình xây dựng và phát triển của chúng tôi</p>
        </div>
        <div class="profile-content">
            <div class="profile-stats">
                <div class="stat-item">
                    <h3>10+</h3>
                    <p>Năm trong ngành</p>
                </div>
                <div class="stat-item">
                    <h3>2000+</h3>
                    <p>Mẫu thiết kế</p>
                </div>
                <div class="stat-item">
                    <h3>500+</h3>
                    <p>Khách hàng thân thiết</p>
                </div>
                <div class="stat-item">
                    <h3>50+</h3>
                    <p>Đối tác phân phối</p>
                </div>
            </div>
        </div>
    </section>
    </x-app-layout>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
