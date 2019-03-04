<b>Name:</b> {$name|truncate:30} <br />
<b>Duration:</b> {$duration} <br />
<b>Country:</b> {$country} <br />
<b>Format: </b> {$format} <br />
<b>Year: </b> {$year} </b> <br />
<b>Quality: </b> {$quality} <br />
<hr>
<b>Tracks for calculation:</b> <br />
{foreach from=$tracks item=$track}
{$track.num}: {$track.title|truncate:20} <br />
{/foreach}
<hr>
<b>Internal release ID:</b> {$id} <br />
<b>Internal tracks ID: </b> {$tid} <br />