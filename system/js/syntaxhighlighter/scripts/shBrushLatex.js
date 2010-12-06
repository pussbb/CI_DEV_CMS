SyntaxHighlighter.brushes.Latex = function()
{
	var keywords =	'if fi then elif else for do done until while break continue case function return in eq ne gt lt ge le';
	//var commands =  'include usepackage begin end ref label includegraphics';
    
	this.regexList = [
		{ regex: new RegExp('%.*','gm'),		css: 'comments' },		// one line comments
		{ regex: SyntaxHighlighter.regexLib.doubleQuotedString,			css: 'string' },		// double quoted strings
		{ regex: new RegExp('\\\\\\w*','gm'),			css: 'keyword' },		// commands
		{ regex: new RegExp(this.getKeywords(keywords), 'gm'),			css: 'function' },		// keywords
		];
}

SyntaxHighlighter.brushes.Latex.prototype	= new SyntaxHighlighter.Highlighter();
SyntaxHighlighter.brushes.Latex.aliases		= ['latex', 'tex'];

