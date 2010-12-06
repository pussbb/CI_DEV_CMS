SyntaxHighlighter.brushes.Yaml = function()
{
	// Contributed by Nicolas Perriault
	
	var constants	= '~ true false on off';

    this.regexList = [
        { regex: SyntaxHighlighter.regexLib.singleLinePerlComments, css: 'comments' },		// comment
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,		css: 'string' },		// double quoted string
		{ regex: SyntaxHighlighter.regexLib.singleQuotedString,		css: 'string' },		// single quoted string
        { regex: /^\s*([a-z0-9\._-])+\s*:/gmi,						css: 'variable' },		// key
		{ regex: /\s?(\.)([a-z0-9\._-])+\s?:/gmi,					css: 'comments' },		// section
		{ regex: /\s(@|:)([a-z0-9\._-])+\s*$/gmi,					css: 'variable bold' },	// variable, reference
		{ regex: /\s+\d+\s?$/gm,									css: 'color2 bold' },	// integers
		{ regex: /(\{|\}|\[|\]|,|~|:)/gm,							css: 'constants' },		// inline hash and array, comma, null
		{ regex: /^\s+(-)+/gm,										css: 'string bold' },	// array list entry
		{ regex: /^---/gm,											css: 'string bold' },	// category
		{ regex: new RegExp(this.getKeywords(constants), 'gmi'),	css: 'constants' }		// constants
        ];
};

SyntaxHighlighter.brushes.Yaml.prototype  = new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Yaml.aliases    = ['yaml', 'yml'];
