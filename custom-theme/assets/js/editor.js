wp.domReady( () => {
	wp.blocks.registerBlockStyle( 'core/image', [ 
		{
			name: 'default',
			label: 'Default',
			isDefault: true,
		},
		{
			name: 'deco1',
			label: 'Takjes',
		},
        {
			name: 'deco2',
			label: 'Graan',
		},
       
	]);
	wp.blocks.registerBlockStyle( 'core/columns', [ 
		{
			name: 'deco1',
			label: 'Takjes',
		},
        {
			name: 'deco2',
			label: 'Graan',
		},
       
	]);
	wp.blocks.registerBlockStyle( 'core/spacer', [ 
		{
			name: 'lijn',
			label: 'Lijn',
		},
	]);
} );