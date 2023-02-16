wp.domReady( () => {
	wp.blocks.registerBlockStyle( 'core/image', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},

		{
			name: 'cover',
			label: 'Groot',
			isDefault: false,
		},
		{
			name: 'contain',
			label: 'Klein',
			isDefault: false,
		},
	]);

 	wp.blocks.unregisterBlockStyle( 'core/image', 'rounded' );

} );
