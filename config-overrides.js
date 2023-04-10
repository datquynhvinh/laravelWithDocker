config.module.rules.unshift({
    test: /\.m?js$/,
    resolve: {
        fullySpecified: false, // disable the behavior
    },
});