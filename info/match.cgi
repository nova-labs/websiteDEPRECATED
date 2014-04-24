#!/usr/bin/perl -w
use strict; use warnings;
use CGI;

my $cgi = CGI->new;

print $cgi->header( 'text/html' );
our $DATA;

print <<"END";
<html>
<head>
<title>Matching Gift Search</title>
</head>
<body>

<h1>Employer Gift Matching and Volunteer Grants</h1>
<p>Does your employer offer employee gift matching or volunteer grants?</p>
<p>Enter their name below to find out!</p>

<form id="search" action="$ENV{ 'SCRIPT_NAME' }" method="post">
<fieldset>
<input type="text" class="text-input" id="filter" value="" />
</fieldset>
</form>
END

if ( $cgi->name ) {
    require "./data.pl";
}

print <<"END";
<dl id="list">
</dl>
</body>
</html>
END
