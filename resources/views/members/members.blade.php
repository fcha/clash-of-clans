@extends('layouts.master')

@section('title', 'Members Page')

@section('content')
	<div id="members-page">
		@if (count($members) > 0)
			@foreach ($members as $member)
				<div class="member">
					<div class="rank">
						<h2>{{ $member['rank']['current'] }}.</h2>
					</div>
					<div class="league">
						<img src="{{ $member['league']['icon']['small'] }}">
					</div>
					<div class="experience">
						<h3>{{ $member['experience'] }}</h3>
					</div>
					<div class="name">
						<h2>{{ $member['name'] }}</h2>
						<p>{{ $member['role']['name'] }}</p>
					</div>
					<div class="details">
						<div class="troops">
							<div>
								<p class="title">Troops donated:</p>
								<h4 class="count">{{ $member['troops']['donated'] }}</h4>
							</div>
							<div>
								<p class="title">Troops received:</p>
								<h4 class="count">{{ $member['troops']['received'] }}</h4>
							</div>
						</div>
						<div class="trophies">
							<div>
								<h2>{{ $member['trophies'] }}</h2>
								<img src="{{ $trophyImage }}">
							</div>
						</div>
					</div>
				</div>
			@endforeach
		@else
		    No members found
		@endif
	</div>
@endsection