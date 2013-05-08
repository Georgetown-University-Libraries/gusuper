<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
  <xsl:param name="max"/>
  <xsl:include href="../gusuper.xsl"/>
  <xsl:template match="/*">
    <div class="combo-set">
      <div name="combo-results">
      	<xsl:apply-templates select="//ul[@id='result_list_f']/li[@class='qlink'][position() &lt;= $max]" mode="dl"/>
      </div>
      <xsl:call-template name="message">
        <xsl:with-param name="count" select="count(//ul[@id='result_list_f']/li[@class='qlink'])"/>
      </xsl:call-template>
    </div>
  </xsl:template>

  <xsl:template match="li" mode="dl">
    <xsl:call-template name="result">
      <xsl:with-param name="title" select="descendant::a/text()"/>
      <xsl:with-param name="link" select="concat($prefix,descendant::a/@href)"/>
      <xsl:with-param name="snippet">
        <xsl:apply-templates select="div" mode="copy"/>
      </xsl:with-param>
    </xsl:call-template>
  </xsl:template>
</xsl:stylesheet>
