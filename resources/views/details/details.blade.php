@extends('layouts.master')

@section('title', 'Clan Page')

@section('content')
	<div id="clan-details-page">
		<div class="clan">
			<div class="badge">
				<p>{{ array_get($clan, 'level') }}</p>
				<img src="{{ array_get($clan, 'badge.medium') }}">
			</div>
			<div class="details">
				<div class="name">
					<h2 class="left">{{ array_get($clan, 'name') }}</h2>
					<h3 class="right">{{ array_get($clan, 'tag') }}</h3>
				</div>
				<div class="details">
					<p class="left">Total points:</p>
					<p class="right">{{ number_format(array_get($clan, 'points')) }}</p>
				</div>
				<div class="details">
					<p class="left">Wars:</p>
					<p class="right">{{ number_format(array_get($clan, 'war.wins')) }} / {{ number_format(array_get($clan, 'war.ties')) }} / {{ number_format(array_get($clan, 'war.losses')) }}</p>
				</div>
				<div class="details">
					<p class="left">War Win Streak:</p>
					<p class="right">{{ number_format(array_get($clan, 'war.win_streak')) }}</p>
				</div>
				<div class="details">
					<p class="left">Members:</p>
					<p class="right">{{ array_get($clan, 'members') }} / 50</p>
				</div>
				<div class="details">
					<p class="left">Type:</p>
					<p class="right">{{ array_get($clan, 'type') }}</p>
				</div>
				<div class="details">
					<p class="left">Required trophies:</p>
					<p class="right">{{ number_format(array_get($clan, 'required_trophies')) }}</p>
				</div>
				<div class="details">
					<p class="left">War Frequency:</p>
					<p class="right">{{ array_get($clan, 'war.frequency') }}</p>
				</div>
				<div class="details">
					<p class="left">Clan Location:</p>
					<p class="right">{{ array_get($clan, 'location.name') }}</p>
				</div>
				<div class="description">
					<p>{{ array_get($clan, 'description') }}</p>
				</div>
			</div>
		</div>
	</div>
@endsection