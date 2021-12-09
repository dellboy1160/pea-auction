<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <hr>
            <div class="nav">
                <!-- <div class="sb-sidenav-menu-heading" style="color:white;font-size:14px">แผงควบคุม</div> -->
                <a class="nav-link" href="main_page.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading" style="color:white;font-size:14px">จัดการข้อมูล</div>
                <a class="nav-link" href="auction.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-list-ul"></i></div>
                    รายการประมูล
                </a>
                <!-- <a class="nav-link" href="document.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    เอกสาร
                </a> -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    เอกสาร
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="document_announce.php">ใบประกาศขาย</a>
                        <a class="nav-link" href="document_offerPrice.php">ใบเสนอราคา</a>

                    </nav>
                </div>
                <!-- <a class="nav-link" href="document_type.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                    ประเภทเอกสาร
                </a> -->
                <a class="nav-link" href="user.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    สมาชิก
                </a>
                <a class="nav-link" href="bank.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-money-check"></i></div>
                    บัญชีธนาคาร
                </a>

                <hr>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
                    STORAGE
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link" href="auction_list.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-list-ul"></i></div>
                            รายการประมูล
                        </a>

                    </nav>
                </div>

            </div>

        </div>

    </nav>
</div>