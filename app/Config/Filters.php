<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		'auth'     => \App\Filters\Auth::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'auth' => [
				'except' => [
					'auth', 'auth/*',
					'home', 'home/*',
					'/'
				]
			]
			// 'honeypot',
			// 'csrf',
		],
		'after'  => [
			'auth' => [
				'except' => [
					'home', 'home/*',
					'mapel', 'mapel/*',
					'gurupelajaran', 'gurupelajaran/*',
					'user', 'user/*',
					'tahunajaran', 'tahunajaran/*',
					'groupsoal', 'groupsoal/*',
					'detail', 'detail/*',
					'gurusoal', 'gurusoal/*',
					'nilai', 'nilai/*',
					'nilaiujian', 'nilaiujian/*',
					'setujian', 'setujian/*',
					'detailsoal', 'detailsoal/*',
					'tes', 'tes/*',
					'daftarujian', 'daftarujian/*',
				]
			],
			'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}
