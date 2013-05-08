<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:param name="max"/>
  <xsl:include href="../gusuper.xsl"/>
  <xsl:template match="/*">
    <div class="combo-set"> 
      <div name="combo-results">
        <xsl:apply-templates select="//ul[@class='libguides_api_list']/li[position() &lt;= $max]" mode="dl"/>
      </div>
      <xsl:call-template name="message">
        <xsl:with-param name="count" select="count(//ul[@class='libguides_api_list']/li)"/>
      </xsl:call-template>
    </div>
  </xsl:template>

  <xsl:template match="li" mode="dl">
    <xsl:call-template name="result">
      <xsl:with-param name="title" select="descendant::a/text()"/>
      <xsl:with-param name="link" select="concat($prefix,descendant::a/@href)"/>
      <xsl:with-param name="snippet">
        <xsl:variable name="str" select="text()"/>
        <xsl:choose>
          <xsl:when test="starts-with($str, ' - ')"><xsl:value-of select="substring-after($str, ' - ')"/></xsl:when>
          <xsl:otherwise><xsl:value-of select="text()"/></xsl:otherwise>
        </xsl:choose>
      </xsl:with-param>
    </xsl:call-template>
  </xsl:template>
</xsl:stylesheet>
