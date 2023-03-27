        <div id="sidebar" class="sidebar" style="background: linear-gradient(to right, #0e0e0d, #55686e);">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow" style="background:url({{url_plug()}}/img/bg.jpg)"></div>
							<div class="image">
								<img src="{{url_plug()}}/img/akun.png" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>{{Auth::user()->name}}
								<small>Admnistrator</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
							<li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
							<li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav"><li class="nav-header">Navigation</li>
					<li>
						<a href="{{url('/')}}">
							<i class="fa fa-home"></i> 
							<span>Home</span>
						</a>
					</li>
					<li>
						<a href="{{url('/warga')}}">
							<i class="fas fa-users"></i> 
							<span>Daftar Warga</span>
						</a>
					</li>
					<li>
						<a href="{{url('/pengumuman')}}">
							<i class="fas fa-bullhorn"></i> 
							<span>Pengumuman</span>
						</a>
					</li>
					<li class="has-sub closed">
						<a href="javascript:;">
							<b class="caret"></b>
							<i class="fa fa-clone"></i>
							<span>Pelayanan</span>
						</a>
						<ul class="sub-menu" style="display: none;">
							@foreach(get_pelayanan() as $pel)
							<li><a href="{{url('pelayanan/'.$pel->tipe)}}">{{$pel->pelayanan}}</a></li>
							@endforeach
						</ul>
					</li>
					<li>
						<a href="{{url('/pengaduan')}}">
							<i class="fas fa-clone"></i> 
							<span>Pengaduan</span>
						</a>
					</li>
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
					
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>