<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:param name="max"/>
  <xsl:include href="../gusuper.xsl"/>
  <xsl:template match="/*">
	<xsl:variable name="pag" select="//p[@class='pagination-info']/text()"/>
    <div class="combo-set">
      <xsl:variable name="nodes" select="//li[contains(@class,'ds-artifact-item')][position() &lt;= $max]" mode="dl"/>
      <div name="combo-results">
      	<xsl:apply-templates select="$nodes[position() &lt;= $max]" mode="dl"/>
      </div>
      <xsl:call-template name="message">
        <xsl:with-param name="count" select="substring-after($pag,' of ')"/>
      </xsl:call-template>
    </div>
  </xsl:template>

  <xsl:template match="li" mode="dl">
      <xsl:choose>
      <xsl:when test="descendant::div[@class='artifact-title']">
        <xsl:call-template name="result">
          <xsl:with-param name="title"><xsl:apply-templates select="descendant::div[@class='artifact-title']" mode="copy"/></xsl:with-param>
          <xsl:with-param name="link" select="concat($prefix,descendant::div[@class='artifact-title']//a/@href)"/>
          <xsl:with-param name="snippet">
            <xsl:apply-templates select="descendant::div[@class='artifact-info']" mode="copy"/>
          </xsl:with-param>
        </xsl:call-template>
      </xsl:when>
      <xsl:when test="span[@class='bold']/a">
        <xsl:call-template name="result">
          <xsl:with-param name="title"><xsl:apply-templates select="descendant::a" mode="copy"/></xsl:with-param>
          <xsl:with-param name="link" select="concat($prefix,span//a/@href)"/>
          <xsl:with-param name="snippet">Community Page</xsl:with-param>
        </xsl:call-template>
      </xsl:when>
      <xsl:when test="descendant::a">
        <xsl:call-template name="result">
          <xsl:with-param name="title"><xsl:apply-templates select="descendant::a" mode="copy"/></xsl:with-param>
          <xsl:with-param name="link" select="concat($prefix,descendant::a/@href)"/>
          <xsl:with-param name="snippet">Collection Page</xsl:with-param>
        </xsl:call-template>
      </xsl:when>
	  <xsl:otherwise>
        <xsl:call-template name="result">
          <xsl:with-param name="title" select="text()"/>
        </xsl:call-template>
	  </xsl:otherwise>
    </xsl:choose>
  </xsl:template>
  
  <xsl:template match="div[@class='artifact-preview']" mode="copy"/>

</xsl:stylesheet>

