<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:param name="label"/>
  <xsl:param name="query"/>
  <xsl:param name="url"/>
  <xsl:param name="prefix"/>
  <xsl:param name="qurl" select="concat($url,$query)"/>
  <xsl:param name="msgnone"/>
  <xsl:param name="msgone"/>
  <xsl:param name="msgoneplus"/>
  <xsl:param name="msgmax"/>
  <xsl:param name="msgmax_brief"/>
  <xsl:param name="msgsearch"/>
  <xsl:param name="max"/>
   

  <xsl:template match="*" mode="copy">
    <xsl:variable name="str">
    <xsl:apply-templates select="*|text()" mode="copy"/>
	</xsl:variable>
	<xsl:value-of select="normalize-space($str)"/>
  </xsl:template>
 
  <xsl:template match="text()" mode="copy">
    <xsl:value-of select="."/>
  </xsl:template>

  <xsl:template name="countString">
    <xsl:param name="str"/>
    <xsl:param name="count"/>
    
    <xsl:variable name="nstr">
        <xsl:call-template name="maxString">
          <xsl:with-param name="str" select="$str"/>
          <xsl:with-param name="count" select="$max"/>
        </xsl:call-template>
    </xsl:variable>
    
    <xsl:choose>
      <xsl:when test="contains($nstr, '_')">
        <xsl:value-of select="concat(substring-before($nstr, '_'), $count, substring-after($nstr, '_'))"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:value-of select="$nstr"/>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template name="maxString">
    <xsl:param name="str"/>
    <xsl:param name="count"/>
    <xsl:choose>
      <xsl:when test="contains($str, '^')">
        <xsl:value-of select="concat(substring-before($str, '^'), $count, substring-after($str, '^'))"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:value-of select="$str"/>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

  <xsl:template name="anchorString">
    <xsl:param name="str"/>
    <xsl:param name="name"/>
    <xsl:choose>
      <xsl:when test="contains($str, '_')">
        <xsl:value-of select="substring-before($str, '_')"/>
        <a>
          <xsl:attribute name="href"><xsl:value-of select="$qurl"/></xsl:attribute>
          <xsl:value-of select="$label"/>
        </a>
        <xsl:value-of select="substring-after($str, '_')"/>
      </xsl:when>
      <xsl:otherwise>
        <a>
          <xsl:attribute name="href"><xsl:value-of select="$qurl"/></xsl:attribute>
          <xsl:value-of select="$str"/>
        </a>
      </xsl:otherwise>
    </xsl:choose>
  </xsl:template>

	<xsl:template name="message">
		<xsl:param name="count" />
		<div class='combo-summary'>
			<xsl:choose>
				<xsl:when test="$count &gt; $max and string-length($msgmax_brief) &gt; 0">
        		  <a>
          		    <xsl:attribute name="href"><xsl:value-of select="$qurl"/></xsl:attribute>
          		    <xsl:value-of select="$msgmax_brief"/>
        		  </a>
				</xsl:when>
				<xsl:otherwise>
					<xsl:choose>
						<xsl:when test="number($count) != $count">
							<xsl:value-of select="$msgnone" />
						</xsl:when>
						<xsl:when test="$count=0">
							<xsl:value-of select="$msgnone" />
						</xsl:when>
						<xsl:when test="$count &gt; $max">
							<xsl:call-template name="countString">
								<xsl:with-param name="str" select="$msgmax" />
								<xsl:with-param name="count" select="$count" />
							</xsl:call-template>
						</xsl:when>
						<xsl:when test="$count=1">
							<xsl:call-template name="countString">
								<xsl:with-param name="str" select="$msgone" />
								<xsl:with-param name="count" select="$count" />
							</xsl:call-template>
						</xsl:when>
						<xsl:otherwise>
							<xsl:call-template name="countString">
								<xsl:with-param name="str" select="$msgoneplus" />
								<xsl:with-param name="count" select="$count" />
							</xsl:call-template>
						</xsl:otherwise>
					</xsl:choose>
					<xsl:text> </xsl:text>
					<xsl:call-template name="anchorString">
						<xsl:with-param name="str" select="$msgsearch" />
						<xsl:with-param name="name" select="$label" />
					</xsl:call-template>
				</xsl:otherwise>
			</xsl:choose>

		</div>
	</xsl:template>

  <xsl:template name="result">
    <xsl:param name="title"/>
    <xsl:param name="link"/>
    <xsl:param name="snippet"/>
  
    <div class='combo-result'>
    <div class='combo-title'>
      <a>
        <xsl:attribute name="href"><xsl:value-of select="$link"/></xsl:attribute>
        <xsl:value-of select="$title"/>
      </a>
    </div>
    <div class='combo-snippet'>
      <xsl:value-of select="$snippet"/>
    </div>
    </div>
  </xsl:template>

</xsl:stylesheet>
